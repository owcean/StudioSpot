import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import Footer from '../components/Footer';
import './Auth.css';

// Mock users – replace with real API calls when you have a backend
const MOCK_USERS = [
  { id: 1, username: 'Admin User', email: 'admin@studiospot.ph', password: 'admin123', role: 'admin' },
  { id: 2, username: 'Jane Doe', email: 'jane@example.com', password: 'user123', role: 'member' },
];

const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const { login } = useAuth();
  const navigate = useNavigate();

  const handleSubmit = (e) => {
    e.preventDefault();
    setError('');
    const found = MOCK_USERS.find(u => u.email === email && u.password === password);
    if (found) {
      login({ id: found.id, username: found.username, email: found.email, role: found.role });
      navigate(found.role === 'admin' ? '/admin' : '/dashboard');
    } else {
      setError('Invalid email or password.');
    }
  };

  return (
    <div className="auth-page" style={{ backgroundImage: "url('/img/cover2.png')" }}>
      <div className="auth-box">
        <h2>Login</h2>
        <p className="auth-sub">Sign in to continue</p>
        {error && <p className="auth-error">{error}</p>}
        <form onSubmit={handleSubmit}>
          <div className="form-group">
            <label>Email</label>
            <input
              type="email"
              placeholder="hello@example.com"
              value={email}
              onChange={e => setEmail(e.target.value)}
              required
            />
          </div>
          <div className="form-group">
            <label>Password</label>
            <input
              type="password"
              placeholder="••••••••"
              value={password}
              onChange={e => setPassword(e.target.value)}
              required
            />
          </div>
          <button type="submit" className="auth-btn">Log In</button>
          <p className="auth-link">Don't have an account? <Link to="/register">Register here</Link></p>
        </form>
      </div>
      <Footer />
    </div>
  );
};

export default Login;
