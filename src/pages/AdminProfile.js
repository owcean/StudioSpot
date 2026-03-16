import React from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import './Dashboard.css';
import './AdminDashboard.css';

const AdminSidebar = () => {
  const { logout } = useAuth();
  const navigate = useNavigate();
  return (
    <aside className="sidebar">
      <ul>
        <li><a href="/admin"><img src="/img/logo.png" alt="Logo" /></a></li>
        <li><a href="/admin"><img src="/img/window.png" alt="Dashboard" /></a></li>
        <li><a href="/admin/schedule"><img src="/img/bookings.png" alt="Schedule" /></a></li>
        <li><a href="/admin/profile"><img src="/img/profile.png" alt="Profile" /></a></li>
        <li>
          <button className="sidebar-logout" onClick={() => { logout(); navigate('/login'); }}>
            <img src="/img/logout.png" alt="Logout" />
          </button>
        </li>
      </ul>
    </aside>
  );
};

const AdminProfile = () => {
  const { user } = useAuth();
  return (
    <div className="dashboard-layout">
      <AdminSidebar />
      <div className="dashboard-main">
        <header className="dash-header">
          <h1>Hi, {user?.username}!</h1>
          <span className="admin-badge">Admin</span>
        </header>
        <div className="profile-wrap">
          <div className="profile-info-box">
            <h2>{user?.username}</h2>
            <p><strong>Email:</strong> {user?.email}</p>
            <p><strong>Role:</strong> {user?.role}</p>
          </div>
          <div className="table-wrap" style={{ padding: 24 }}>
            <h2 style={{ fontFamily: 'var(--font-display)', color: 'var(--brown-dark)', textAlign: 'center', marginBottom: 12 }}>Admin Info</h2>
            <p style={{ textAlign: 'center', color: 'var(--text-mid)', fontSize: 14 }}>
              You have full access to manage bookings, view all users, and control studio listings.
            </p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default AdminProfile;
