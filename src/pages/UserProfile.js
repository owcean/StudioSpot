import React from 'react';
import Sidebar from '../components/Sidebar';
import { useAuth } from '../context/AuthContext';
import './Dashboard.css';

const mockBookings = [
  { id: 1, studio: 'Minimalist White Room', date: '2026-03-20', time: '10:00', status: 'Confirmed' },
  { id: 2, studio: 'Boho Cozy Space', date: '2026-03-28', time: '14:00', status: 'Pending' },
];

const UserProfile = () => {
  const { user } = useAuth();

  return (
    <div className="dashboard-layout">
      <Sidebar />
      <div className="dashboard-main">
        <header className="dash-header">
          <h1>Hi, {user?.username}!</h1>
        </header>
        <div className="profile-wrap">
          <div className="profile-info-box">
            <h2>{user?.username}</h2>
            <p><strong>Email:</strong> {user?.email}</p>
            <p><strong>Role:</strong> {user?.role}</p>
          </div>

          <div className="table-wrap">
            <h2>My Bookings</h2>
            <table className="bookings-table">
              <thead>
                <tr>
                  <th>Studio</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                {mockBookings.map(b => (
                  <tr key={b.id}>
                    <td>{b.studio}</td>
                    <td>{b.date}</td>
                    <td>{b.time}</td>
                    <td>
                      <span style={{
                        padding: '4px 10px',
                        borderRadius: 12,
                        background: b.status === 'Confirmed' ? '#eafaf1' : '#fef9e7',
                        color: b.status === 'Confirmed' ? '#27ae60' : '#d4ac0d',
                        fontSize: 13,
                        fontWeight: 600,
                      }}>
                        {b.status}
                      </span>
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

export default UserProfile;
