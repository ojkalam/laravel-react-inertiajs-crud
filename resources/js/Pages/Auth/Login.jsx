import { Link, useForm } from "@inertiajs/react";
import GuestLayout from "@/layouts/GuestLayout";

export default function Login() {
  const { data, setData, post, processing, errors } = useForm({
    email: "",
    password: "",
  });

  function handleChange(e) {
    const { id, value } = e.target;
    setData(id, value);
  }

  function handleSubmit(e) {
    e.preventDefault();
    post("/login");
  }
  return (
    <GuestLayout>
      {/* Header */}
      <div className="text-center">
        <div className="mx-auto h-16 w-16 bg-gradient-to-br from-purple-500 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg mb-6">
          <svg
            className="h-8 w-8 text-white"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              strokeLinecap="round"
              strokeLinejoin="round"
              strokeWidth="2"
              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
            ></path>
          </svg>
        </div>
        <h2 className="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
        <p className="text-gray-600">Please sign in to your account</p>
      </div>

      {/* Login Form */}
      <div className="bg-white rounded-2xl shadow-xl p-8 card-hover">
        <form className="space-y-6" onSubmit={handleSubmit}>
          {/* Email Input */}
          <div className="input-group">
            <input
              id="email"
              name="email"
              type="email"
              value={data.email}
              onChange={handleChange}
              required
              className="input-field"
              placeholder=" "
            />
            <label htmlFor="email" className="input-label">
              Email Address
            </label>
            {errors.email && (
              <div className="text-red-500 text-sm mt-1">{errors.email}</div>
            )}
          </div>

          {/* Password Input */}
          <div className="input-group">
            <div className="relative">
              <input
                id="password"
                name="password"
                type="password"
                value={data.password}
                onChange={handleChange}
                required
                className="input-field pr-10"
                placeholder=" "
              />
              <label htmlFor="password" className="input-label">
                Password
              </label>
              <button
                type="button"
                className="absolute right-0 top-4 text-gray-400 hover:text-gray-600 transition-colors"
              >
                <svg
                  id="eyeIcon"
                  className="h-5 w-5"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                  ></path>
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                  ></path>
                </svg>
              </button>
            </div>
            {errors.password && (
              <div className="text-red-500 text-sm mt-1">{errors.password}</div>
            )}
          </div>

          {/* Remember Me & Forgot Password */}
          <div className="flex items-center justify-between">
            <label className="flex items-center">
              <input
                type="checkbox"
                className="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition-colors"
              />
              <span className="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
            <a
              href="#"
              className="text-sm text-blue-600 hover:text-blue-800 transition-colors"
            >
              Forgot password?
            </a>
          </div>

          {/* Submit Button */}
          <button
            id="submitBtn"
            type="submit"
            disabled={processing}
            className="btn-primary w-full py-3 px-4 text-white font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          >
            {processing ? "Signing in..." : "Sign in"}
          </button>
        </form>
        {/* Sign in Link */}
        <p className="mt-6 text-center text-sm text-gray-600">
          Don't have an account?
          <Link
            href={route("register")}
            className="ml-1 text-gradient font-medium hover:underline"
          >
            Register
          </Link>
        </p>
      </div>
    </GuestLayout>
  );
}
