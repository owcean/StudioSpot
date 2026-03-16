import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import './Auth.css';

const Register = () => {
  const [form, setForm] = useState({ username: '', email: '', password: '', confirm_password: '', role: 'member' });
  const [error, setError] = useState('');
  const [success, setSuccess] = useState('');
  const navigate = useNavigate();

  const handleChange = e => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = (e) => {
    e.preventDefault();
    if (form.password !== form.confirm_password) {
      setError('Passwords do not match.');
      return;
    }
    // In a real app, POST to your API here
    setSuccess('Registration successful! Redirecting to login...');
    setTimeout(() => navigate('/login'), 1500);
  };

  return (
    <div className="auth-page signup-page">
      <div className="auth-box">
        <h2>Sign Up</h2>
        {error && <p className="auth-error">{error}</p>}
        {success && <p className="auth-success">{success}</p>}
        <form onSubmit={handleSubmit}>
          <div className="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="JohnDoe" value={form.username} onChange={handleChange} required />
          </div>
          <div className="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="hello@example.com" value={form.email} onChange={handleChange} required />
          </div>
          <div className="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••" value={form.password} onChange={handleChange} required />
          </div>
          <div className="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="••••••••" value={form.confirm_password} onChange={handleChange} required />
          </div>
          <div className="form-group">
            <label>Role</label>
            <select name="role" value={form.role} onChange={handleChange} required>
              <option value="member">Member</option>
              <option value="admin">Admin</option>
            </select>
          </div>
          <button type="submit" className="auth-btn">Register</button>
          <Link to="/login" className="back-login-btn">Back to Login</Link>
        </form>
      </div>
    </div>
  );
};

export default Register;
