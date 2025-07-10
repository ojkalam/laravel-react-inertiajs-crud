# GIMINI Development Guidelines

## Laravel + React + Inertia.js Best Practices

This document outlines the best practices and guidelines for building web applications using Laravel backend with React frontend connected through Inertia.js.

## Table of Contents

1. [Project Structure](#project-structure)
2. [Laravel Backend Guidelines](#laravel-backend-guidelines)
3. [React Frontend Guidelines](#react-frontend-guidelines)
4. [Inertia.js Best Practices](#inertiajs-best-practices)
5. [Security Guidelines](#security-guidelines)
6. [Performance Optimization](#performance-optimization)
7. [Code Quality Standards](#code-quality-standards)
8. [Database Guidelines](#database-guidelines)
9. [API Design Principles](#api-design-principles)
10. [Testing Guidelines](#testing-guidelines)

## Project Structure

### Directory Organization
```
app/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   ├── Requests/
│   └── Resources/
├── Models/
├── Services/
└── Repositories/

resources/
├── js/
│   ├── Components/
│   ├── Pages/
│   ├── Layouts/
│   ├── Hooks/
│   └── Utils/
└── css/

database/
├── migrations/
├── seeders/
└── factories/
```

### File Naming Conventions
- **Laravel**: Use PascalCase for classes, camelCase for methods
- **React**: Use PascalCase for components, camelCase for functions/variables
- **Database**: Use snake_case for table names and columns
- **Routes**: Use kebab-case for URLs

## Laravel Backend Guidelines

### Controller Best Practices

```php
// ✅ Good: Single responsibility, clear naming
class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->paginate(15);

        return Inertia::render('Users/Index', [
            'users' => $users,
            'filters' => $request->only(['search'])
        ]);
    }
}

// ❌ Avoid: Fat controllers with business logic
class UserController extends Controller
{
    public function store(Request $request)
    {
        // Don't put complex business logic here
        // Use services or actions instead
    }
}
```

### Model Guidelines

```php
// ✅ Good: Use fillable, relationships, and accessors
class User extends Model
{
    protected $fillable = [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
```

### Service Layer Pattern

```php
// ✅ Create services for complex business logic
class UserService
{
    public function createUser(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = User::create($data);
            $user->profile()->create($data['profile']);
            // Send welcome email
            Mail::to($user)->send(new WelcomeEmail($user));
            return $user;
        });
    }
}
```

### Request Validation

```php
// ✅ Use Form Request classes
class StoreUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'This email is already registered.'
        ];
    }
}
```

## React Frontend Guidelines

### Component Structure

```jsx
// ✅ Good: Functional components with hooks
import React, { useState, useEffect } from 'react';
import { Head } from '@inertiajs/react';

const UserIndex = ({ users, filters }) => {
    const [search, setSearch] = useState(filters.search || '');

    const handleSearch = (e) => {
        e.preventDefault();
        // Use Inertia router for navigation
        router.get('/users', { search }, {
            preserveState: true,
            preserveScroll: true
        });
    };

    return (
        <>
            <Head title="Users" />
            <div className="container mx-auto px-4">
                <h1 className="text-2xl font-bold mb-6">Users</h1>
                {/* Component content */}
            </div>
        </>
    );
};

export default UserIndex;
```

### Component Organization

```jsx
// ✅ Group related components
components/
├── UI/
│   ├── Button.jsx
│   ├── Input.jsx
│   └── Modal.jsx
├── Forms/
│   ├── UserForm.jsx
│   └── PostForm.jsx
└── Layout/
    ├── Header.jsx
    ├── Sidebar.jsx
    └── Footer.jsx
```

### State Management

```jsx
// ✅ Use local state for component-specific data
const [loading, setLoading] = useState(false);
const [errors, setErrors] = useState({});

// ✅ Use Inertia's built-in state management for form data
const { data, setData, post, processing, errors } = useForm({
    name: '',
    email: ''
});
```

## Inertia.js Best Practices

### Page Components

```jsx
// ✅ Structure page components consistently
const UserShow = ({ user, posts }) => {
    return (
        <AuthenticatedLayout>
            <Head title={`User: ${user.name}`} />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <UserProfile user={user} />
                    <UserPosts posts={posts} />
                </div>
            </div>
        </AuthenticatedLayout>
    );
};
```

### Form Handling

```jsx
// ✅ Use Inertia's useForm hook
const UserForm = ({ user = null }) => {
    const { data, setData, post, put, processing, errors } = useForm({
        name: user?.name || '',
        email: user?.email || ''
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        
        if (user) {
            put(`/users/${user.id}`);
        } else {
            post('/users');
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <Input
                label="Name"
                value={data.name}
                onChange={(e) => setData('name', e.target.value)}
                error={errors.name}
            />
            <Button type="submit" disabled={processing}>
                {user ? 'Update' : 'Create'} User
            </Button>
        </form>
    );
};
```

### Data Sharing

```jsx
// ✅ Share data globally using Inertia's shared data
// In Laravel controller
return Inertia::render('Dashboard', [
    'stats' => $stats
])->with([
    'user' => auth()->user(),
    'notifications' => auth()->user()->notifications
]);

// In React component
const { user, notifications } = usePage().props;
```

## Security Guidelines

### Authentication & Authorization

```php
// ✅ Use middleware for protection
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('users', UserController::class)->middleware('can:manage-users');
});
```

### Input Validation

```php
// ✅ Always validate and sanitize input
class StorePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'title' => strip_tags($this->title),
            'content' => clean($this->content) // Use HTMLPurifier
        ]);
    }
}
```

### CSRF Protection

```jsx
// ✅ CSRF tokens are handled automatically by Inertia
// But ensure they're included in your layout
<Head>
    <meta name="csrf-token" content={csrf_token} />
</Head>
```

## Performance Optimization

### Database Optimization

```php
// ✅ Use eager loading to prevent N+1 queries
$users = User::with(['posts', 'profile'])->paginate(15);

// ✅ Use database indexes
Schema::table('posts', function (Blueprint $table) {
    $table->index(['user_id', 'created_at']);
    $table->index('slug');
});
```

### Frontend Optimization

```jsx
// ✅ Use React.memo for expensive components
const UserList = React.memo(({ users }) => {
    return (
        <div>
            {users.map(user => <UserCard key={user.id} user={user} />)}
        </div>
    );
});

// ✅ Lazy load components
const LazyDashboard = React.lazy(() => import('./Pages/Dashboard'));
```

### Caching Strategy

```php
// ✅ Cache expensive queries
$posts = Cache::remember('featured-posts', 3600, function () {
    return Post::where('is_featured', true)->with('author')->get();
});
```

## Code Quality Standards

### PHP Standards

```php
// ✅ Follow PSR-12 coding standards
// ✅ Use type hints
public function store(StoreUserRequest $request): User
{
    return $this->userService->createUser($request->validated());
}

// ✅ Use meaningful variable names
$activeUsers = User::where('is_active', true)->get();
```

### JavaScript Standards

```jsx
// ✅ Use ESLint and Prettier
// ✅ Consistent naming conventions
const handleUserSubmit = (userData) => {
    // Clear function names
};

// ✅ Use PropTypes or TypeScript
UserCard.propTypes = {
    user: PropTypes.object.isRequired,
    onEdit: PropTypes.func
};
```

## Database Guidelines

### Migration Best Practices

```php
// ✅ Use descriptive migration names
// 2024_01_01_000000_create_users_table.php
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->boolean('is_active')->default(true);
        $table->rememberToken();
        $table->timestamps();
        
        $table->index(['email', 'is_active']);
    });
}
```

### Seeder Organization

```php
// ✅ Create realistic test data
class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->count(50)
            ->has(Post::factory()->count(3))
            ->create();
    }
}
```

## Testing Guidelines

### Laravel Testing

```php
// ✅ Write feature tests for user workflows
class UserManagementTest extends TestCase
{
    public function test_admin_can_create_user()
    {
        $admin = User::factory()->admin()->create();
        
        $this->actingAs($admin)
            ->post('/users', [
                'name' => 'John Doe',
                'email' => 'john@example.com'
            ])
            ->assertRedirect('/users')
            ->assertSessionHas('success');
            
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com'
        ]);
    }
}
```

### Frontend Testing

```jsx
// ✅ Test component behavior
import { render, screen, fireEvent } from '@testing-library/react';
import UserForm from '../UserForm';

test('submits form with valid data', async () => {
    render(<UserForm />);
    
    fireEvent.change(screen.getByLabelText('Name'), {
        target: { value: 'John Doe' }
    });
    
    fireEvent.click(screen.getByRole('button', { name: 'Create User' }));
    
    expect(screen.getByText('User created successfully')).toBeInTheDocument();
});
```

## Error Handling

### Backend Error Handling

```php
// ✅ Use try-catch blocks appropriately
public function store(StoreUserRequest $request)
{
    try {
        $user = $this->userService->createUser($request->validated());
        
        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    } catch (Exception $e) {
        Log::error('User creation failed', [
            'error' => $e->getMessage(),
            'data' => $request->validated()
        ]);
        
        return back()->with('error', 'Failed to create user');
    }
}
```

### Frontend Error Handling

```jsx
// ✅ Display user-friendly error messages
const UserForm = () => {
    const { errors } = usePage().props;
    
    return (
        <div>
            {errors.general && (
                <div className="alert alert-error">
                    {errors.general}
                </div>
            )}
            {/* Form fields */}
        </div>
    );
};
```

## Deployment Guidelines

### Environment Configuration

```bash
# ✅ Use environment-specific settings
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# ✅ Use strong, unique keys
APP_KEY=base64:your-generated-key

# ✅ Configure database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=strong_password
```

### Build Process

```bash
# ✅ Production build steps
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

## Common Pitfalls to Avoid

### ❌ Don't Do This

```php
// Don't put business logic in controllers
class UserController extends Controller
{
    public function store(Request $request)
    {
        // Don't do complex operations here
        $user = User::create($request->all());
        Mail::to($user)->send(new WelcomeEmail());
        // ... more business logic
    }
}
```

```jsx
// Don't use inline styles everywhere
<div style={{ backgroundColor: 'red', padding: '10px' }}>
    Content
</div>

// Don't forget to handle loading states
const UserList = ({ users }) => {
    // Missing loading state handling
    return (
        <div>
            {users.map(user => <UserCard key={user.id} user={user} />)}
        </div>
    );
};
```

### ✅ Do This Instead

```php
// Use services for business logic
class UserController extends Controller
{
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        
        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }
}
```

```jsx
// Use CSS classes and handle loading states
const UserList = ({ users, loading }) => {
    if (loading) {
        return <div className="loading-spinner">Loading...</div>;
    }
    
    return (
        <div className="user-list">
            {users.map(user => <UserCard key={user.id} user={user} />)}
        </div>
    );
};
```

## Final Reminders

1. **Always validate user input** on both frontend and backend
2. **Use consistent naming conventions** across the entire application
3. **Write tests** for critical functionality
4. **Document your code** with clear comments
5. **Follow the principle of least privilege** for database access
6. **Keep dependencies up to date** and audit for security vulnerabilities
7. **Use version control effectively** with meaningful commit messages
8. **Monitor application performance** and optimize bottlenecks
9. **Implement proper logging** for debugging and monitoring
10. **Plan for scalability** from the beginning

Remember: These guidelines are meant to ensure code quality, security, and maintainability. Adapt them based on your specific project requirements while maintaining these core principles.
