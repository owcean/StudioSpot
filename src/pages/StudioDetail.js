import React from 'react';
import { Link } from 'react-router-dom';
import Sidebar from '../components/Sidebar';
import { useAuth } from '../context/AuthContext';
import './Dashboard.css';
import './StudioDetail.css';

const studioData = {
  minimalist: {
    title: 'Minimalist White Room',
    images: ['/img/MINIMALIST 1.jpg', '/img/MINIMALIST 2.jpg', '/img/MINIMALIST 3.jpg', '/img/MINIMALIST 5.jpg'],
    weekday: 'Php 1,500 per hour VAT inc.\nMinimum of 6 hours\nMaximum of 12 hours',
    weekend: 'Php 2,000 per hour VAT inc.\nMinimum of 6 hours\nMaximum of 12 hours',
    details: ['All-white aesthetic', 'Professional lighting', 'Large windows', 'Modern props available'],
    contact: '09994899536',
  },
  boho: {
    title: 'Boho Cozy Space',
    images: ['/img/boho 1.jpg', '/img/boho 2.jpg', '/img/boho 3.jpg', '/img/boho 4.jpg'],
    weekday: 'Php 1,500 per hour VAT inc.\nMinimum of 6 hours\nMaximum of 12 hours',
    weekend: 'Php 2,000 per hour VAT inc.\nMinimum of 6 hours\nMaximum of 12 hours',
    details: ['Earthy tones and textures', 'Natural light', 'Bohemian props', 'Cozy atmosphere'],
    contact: '09994899536',
  },
  corpo: {
    title: 'Corporate Studio',
    images: ['/img/corpo 1.jpg', '/img/corpo 2.jpg', '/img/corpo 3.jpg', '/img/corpo 4.jfif'],
    weekday: 'Php 1,500 per hour VAT inc.\nMinimum of 6 hours\nMaximum of 12 hours',
    weekend: 'Php 2,000 per hour VAT inc.\nMinimum of 6 hours\nMaximum of 12 hours',
    details: ['Sleek modern backdrop', 'Premium lighting', 'Professional setup', 'Meeting room available'],
    contact: '09994899536',
  },
  custom: {
    title: 'Custom Setup',
    images: ['/img/custom1.jpg', '/img/custom2.jpg', '/img/custom3.jpg', '/img/custom4.jpg'],
    weekday: 'Php 1,500 per hour VAT inc.\nMinimum of 6 hours\nMaximum of 12 hours',
    weekend: 'Php 2,000 per hour VAT inc.\nMinimum of 6 hours\nMaximum of 12 hours',
    details: ['Fully customizable space', 'Any theme possible', 'Props on request', 'Personalized setup'],
    contact: '09994899536',
  },
};

const StudioDetail = ({ studioKey }) => {
  const { user } = useAuth();
  const studio = studioData[studioKey] || studioData.minimalist;

  return (
    <div className="dashboard-layout">
      <Sidebar />
      <div className="dashboard-main">
        <header className="dash-header">
          <h1>Hi, {user?.username}!</h1>
        </header>
        <div className="studio-detail-box">
          <h1 className="studio-detail-title">{studio.title}</h1>

          <div className="studio-gallery">
            {studio.images.map((img, i) => (
              <img key={i} src={img} alt={`${studio.title} ${i + 1}`} />
            ))}
          </div>

          <div className="studio-rates-row">
            <div className="rate-card">
              <h3>Rates</h3>
              <div className="rate-cols">
                <div className="rate-col">
                  <h4>Weekdays</h4>
                  <p>{studio.weekday}</p>
                </div>
                <div className="rate-col">
                  <h4>Weekends</h4>
                  <p>{studio.weekend}</p>
                </div>
              </div>
            </div>
            <div className="rate-card">
              <h3>Studio Details</h3>
              <ul>
                {studio.details.map((d, i) => <li key={i}>{d}</li>)}
              </ul>
            </div>
          </div>

          <div style={{ textAlign: 'center', marginTop: 28 }}>
            <p className="contact-line">📞 Contact: {studio.contact}</p>
            <Link to="/dashboard/booking" className="book-btn" style={{ marginTop: 12, display: 'inline-block' }}>
              BOOK THIS STUDIO
            </Link>
          </div>
        </div>
      </div>
    </div>
  );
};

export default StudioDetail;
