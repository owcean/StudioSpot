import React, { useState } from 'react';
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

const mockSchedule = [
  { id: 1, name: 'Maria Santos', studio: 'Minimalist White Room', date: '2026-03-16', time: '09:00', contact: '09171234567', status: 'Confirmed' },
  { id: 2, name: 'Juan dela Cruz', studio: 'Boho Cozy Space', date: '2026-03-16', time: '13:00', contact: '09281234567', status: 'Pending' },
  { id: 3, name: 'Ana Reyes', studio: 'Corporate Studio', date: '2026-03-17', time: '10:00', contact: '09991234567', status: 'Confirmed' },
  { id: 4, name: 'Carlo Mendoza', studio: 'Custom Setup', date: '2026-03-18', time: '14:00', contact: '09551234567', status: 'Pending' },
  { id: 5, name: 'Lea Gonzales', studio: 'Minimalist White Room', date: '2026-03-19', time: '11:00', contact: '09661234567', status: 'Confirmed' },
];

const statusColors = {
  Confirmed: { bg: '#eafaf1', color: '#27ae60' },
  Pending: { bg: '#fef9e7', color: '#d4ac0d' },
  Cancelled: { bg: '#fdecea', color: '#c0392b' },
};

const AdminSchedule = () => {
  const { user } = useAuth();
  const [bookings, setBookings] = useState(mockSchedule);

  const updateStatus = (id, status) => {
    setBookings(prev => prev.map(b => b.id === id ? { ...b, status } : b));
  };

  return (
    <div className="dashboard-layout">
      <AdminSidebar />
      <div className="dashboard-main">
        <header className="dash-header">
          <h1>Hi, {user?.username}!</h1>
          <span className="admin-badge">Admin</span>
        </header>

        <div className="table-wrap">
          <h2>Booking Schedule</h2>
          <div style={{ overflowX: 'auto' }}>
            <table className="bookings-table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Studio</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Contact</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                {bookings.map(b => (
                  <tr key={b.id}>
                    <td>{b.name}</td>
                    <td>{b.studio}</td>
                    <td>{b.date}</td>
                    <td>{b.time}</td>
                    <td>{b.contact}</td>
                    <td>
                      <span style={{
                        padding: '4px 10px',
                        borderRadius: 12,
                        fontSize: 12,
                        fontWeight: 600,
                        background: statusColors[b.status]?.bg || '#eee',
                        color: statusColors[b.status]?.color || '#333',
                      }}>
                        {b.status}
                      </span>
                    </td>
                    <td>
                      <div style={{ display: 'flex', gap: 6, justifyContent: 'center' }}>
                        <button
                          onClick={() => updateStatus(b.id, 'Confirmed')}
                          style={{ padding: '4px 10px', background: '#27ae60', color: '#fff', border: 'none', borderRadius: 6, fontSize: 12, cursor: 'pointer' }}
                        >✓</button>
                        <button
                          onClick={() => updateStatus(b.id, 'Cancelled')}
                          style={{ padding: '4px 10px', background: '#c0392b', color: '#fff', border: 'none', borderRadius: 6, fontSize: 12, cursor: 'pointer' }}
                        >✕</button>
                      </div>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  );
};

export default AdminSchedule;
