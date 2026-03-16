import React from 'react';
import { Link } from 'react-router-dom';
import Sidebar from '../components/Sidebar';
import { useAuth } from '../context/AuthContext';
import './Dashboard.css';

const rooms = [
  {
    id: 1,
    name: 'Minimalist White Room',
    image: '/img/MINIMALIST 1.jpg',
    desc: 'Step into a space designed for pure inspiration. Our all-white, minimalist studio is the perfect canvas for your photoshoots, content creation, and creative projects.',
    path: '/dashboard/minimalist',
  },
  {
    id: 2,
    name: 'Boho Cozy Space',
    image: '/img/boho 2.jpg',
    desc: 'Surround yourself with earthy tones, soft textures, and dreamy natural light. Our Boho Cozy Studio is designed for intimate photoshoots and lifestyle content.',
    path: '/dashboard/boho',
  },
  {
    id: 3,
    name: 'Corporate Studio',
    image: '/img/corpo 3.jpg',
    desc: 'Designed for headshots, executive branding, and polished content creation. Our Corporate Studio offers a sleek, modern backdrop that elevates your professional image.',
    path: '/dashboard/corpo',
  },
  {
    id: 4,
    name: 'Customize Setup',
    image: '/img/custom5.jpg',
    desc: 'Need a space that fits your unique style? Our Custom Studio Setup lets you transform the space to match your creative needs — minimal, modern, warm, or whimsical.',
    path: '/dashboard/custom',
  },
];

const StudioListings = () => {
  const { user } = useAuth();
  return (
    <div className="dashboard-layout">
      <Sidebar />
      <div className="dashboard-main">
        <header className="dash-header">
          <h1>Hi, {user?.username}!</h1>
        </header>
        <h2 style={{ fontFamily: 'var(--font-display)', color: 'var(--brown-dark)', marginBottom: 24 }}>Studio Listing</h2>
        <div className="dash-room-list">
          {rooms.map(r => (
            <div key={r.id} className="dash-room">
              <img src={r.image} alt={r.name} className="dash-room-img" />
              <div className="dash-room-info">
                <h2>{r.name}</h2>
                <p>{r.desc}</p>
                <Link to={r.path} className="more-info-btn">MORE INFO</Link>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default StudioListings;
