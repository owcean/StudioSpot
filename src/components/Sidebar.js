import React from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import './Sidebar.css';

const Sidebar = () => {
  const { logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = () => {
    logout();
    navigate('/login');
  };

  return (
    <aside className="sidebar">
      <ul>
        <li>
          <Link to="/dashboard" title="Dashboard">
            <img src="/img/logo.png" alt="Studio Spot" />
          </Link>
        </li>
        <li>
          <Link to="/dashboard" title="Home">
            <img src="/img/window.png" alt="Dashboard" />
          </Link>
        </li>
        <li>
          <Link to="/dashboard/studios" title="Studios">
            <img src="/img/bookings.png" alt="Studios" />
          </Link>
        </li>
        <li>
          <Link to="/dashboard/profile" title="Profile">
            <img src="/img/profile.png" alt="Profile" />
          </Link>
        </li>
        <li>
          <button onClick={handleLogout} title="Logout" className="sidebar-logout">
            <img src="/img/logout.png" alt="Logout" />
          </button>
        </li>
      </ul>
    </aside>
  );
};

export default Sidebar;
