import React from 'react';
import { Link } from 'react-router-dom';
import Sidebar from '../components/Sidebar';
import { useAuth } from '../context/AuthContext';
import './Dashboard.css';

const studios = [
  { id: 1, image: '/img/minimalist.jpg', name: 'Minimalist White Room', path: '/dashboard/minimalist' },
  { id: 2, image: '/img/boho 4.jpg', name: 'Boho Cozy Space', path: '/dashboard/boho' },
  { id: 3, image: '/img/corpo 2.jpg', name: 'Corporate Studio', path: '/dashboard/corpo' },
  { id: 4, image: '/img/custom1.jpg', name: 'Custom Setup', path: '/dashboard/custom' },
];

const UserDashboard = () => {
  const { user } = useAuth();

  return (
    <div className="dashboard-layout">
      <Sidebar />
      <div className="dashboard-main">
        <header className="dash-header">
          <h1>Hi, {user?.username}!</h1>
        </header>

        <section className="studio-intro">
          <h1>Your Studio, Your Story</h1>
          <p>
            Stay on top of your bookings with ease. Check your upcoming sessions,
            review past shoots, and get ready for your next creative moment.
          </p>
          <Link to="/dashboard/studios" className="book-btn">BOOK NOW!</Link>
        </section>

        <section className="studio-cards">
          {studios.map(s => (
            <Link to={s.path} key={s.id} className="studio-card">
              <img src={s.image} alt={s.name} />
              <h3>{s.name}</h3>
            </Link>
          ))}
        </section>
      </div>
    </div>
  );
};

export default UserDashboard;
