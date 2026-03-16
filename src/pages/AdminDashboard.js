import React from 'react';
import { useNavigate } from 'react-router-dom';
import { Line, Bar } from 'react-chartjs-2';
import {
  Chart as ChartJS,
  CategoryScale, LinearScale, PointElement, LineElement,
  BarElement, Title, Tooltip, Legend,
} from 'chart.js';
import { useAuth } from '../context/AuthContext';
import './AdminDashboard.css';

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, BarElement, Title, Tooltip, Legend);

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

const earningsData = {
  labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
  datasets: [{
    label: 'Earnings (₱)',
    data: [20000, 25000, 35000, 40000],
    borderColor: '#8b6f4b',
    backgroundColor: 'rgba(139,111,75,0.08)',
    tension: 0.4,
    fill: true,
  }],
};

const bookingsData = {
  labels: ['Minimalist', 'Boho', 'Corporate', 'Custom'],
  datasets: [{
    label: 'Bookings',
    data: [8, 12, 20, 15],
    backgroundColor: ['#d6a99a', '#b48c7f', '#8b6f4b', '#5a3921'],
    borderRadius: 6,
  }],
};

const chartOpts = { responsive: true, plugins: { legend: { display: false } } };

const AdminDashboard = () => {
  const { user } = useAuth();

  const stats = [
    { label: 'Studio Types', value: 4 },
    { label: 'New Bookings', value: 55 },
    { label: 'Users', value: 128 },
  ];

  return (
    <div className="dashboard-layout">
      <AdminSidebar />
      <div className="dashboard-main">
        <header className="dash-header">
          <h1>Hi, {user?.username}!</h1>
          <span className="admin-badge">Admin</span>
        </header>

        <div className="admin-stats">
          {stats.map(s => (
            <div key={s.label} className="stat-card">
              <h2>{s.value}</h2>
              <p>{s.label}</p>
            </div>
          ))}
        </div>

        <div className="admin-charts">
          <div className="chart-card">
            <h3>Monthly Earnings</h3>
            <Line data={earningsData} options={chartOpts} />
          </div>
          <div className="chart-card">
            <h3>Bookings by Room</h3>
            <Bar data={bookingsData} options={chartOpts} />
          </div>
        </div>
      </div>
    </div>
  );
};

export default AdminDashboard;
