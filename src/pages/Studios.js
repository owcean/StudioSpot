import React, { useState } from 'react';
import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import './Studios.css';

const studios = [
  { id: 1, image: '/img/MINIMALIST 1.jpg', name: 'Minimalist White Room' },
  { id: 2, image: '/img/boho 1.jpg', name: 'Boho Cozy Space' },
  { id: 3, image: '/img/corpo 1.jpg', name: 'Corporate Studio' },
  { id: 4, image: '/img/customize page.jfif', name: 'Custom Setup' },
];

const features = [
  'Multiple themed rooms with unique aesthetics',
  'Customizable backdrops and props',
  'Professional lighting setup available',
  'Spacious and comfortable environment',
  'Air-conditioned space for a smooth shoot',
  'Easy access and parking',
];

const Studios = () => {
  const [fullscreen, setFullscreen] = useState(null);

  return (
    <div className="studios-page">
      <Navbar />
      <main className="studios-container">
        <h1 className="studios-heading">Studio Listing</h1>

        <div className="studio-grid">
          {studios.map(s => (
            <div key={s.id} className="studio-item" onClick={() => setFullscreen(s.image)}>
              <img src={s.image} alt={s.name} />
              <h3>{s.name}</h3>
            </div>
          ))}
        </div>

        <div className="info-card">
          <h2>Studio Features</h2>
          <ul>
            {features.map((f, i) => <li key={i}>{f}</li>)}
          </ul>
        </div>

        <div className="info-card">
          <h2>Rates & Booking</h2>
          <p><strong>Hourly Rate:</strong> Starts at 1,000 Pesos</p>
          <p><strong>Availability:</strong> Open daily, book in advance</p>
          <p><strong>How to Book:</strong> Contact us via <a href="mailto:StudioSpot@gmail.com">StudioSpot@gmail.com</a></p>
          <p><strong>Inquiries:</strong> 09994899536</p>
        </div>
      </main>

      {fullscreen && (
        <div className="fullscreen-overlay" onClick={() => setFullscreen(null)}>
          <img src={fullscreen} alt="Full view" />
          <button className="fs-close" onClick={() => setFullscreen(null)}>✕</button>
        </div>
      )}

      <Footer />
    </div>
  );
};

export default Studios;
