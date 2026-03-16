import React, { useState } from 'react';
import Sidebar from '../components/Sidebar';
import { useAuth } from '../context/AuthContext';
import './Dashboard.css';
import './Booking.css';

const Booking = () => {
  const { user } = useAuth();
  const [form, setForm] = useState({ name: '', email: '', contact_number: '', date: '', time: '', comments: '' });
  const [submitted, setSubmitted] = useState(false);

  const handleChange = e => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = (e) => {
    e.preventDefault();
    // In a real app, POST to backend API here
    setSubmitted(true);
  };

  return (
    <div className="booking-page-bg" style={{ backgroundImage: "url('/img/cover3.jpeg')" }}>
      <Sidebar />
      <div className="booking-center">
        <div className="booking-container">
          <h1>BOOK YOUR STUDIO!</h1>
          {submitted ? (
            <div className="booking-success">
              <p>🎉 Booking submitted!</p>
              <p>We'll reach out at <strong>{form.email || user?.email}</strong> to confirm your session.</p>
              <button onClick={() => setSubmitted(false)} className="book-again-btn">Book Another</button>
            </div>
          ) : (
            <div className="booking-box">
              <div className="booking-img-side">
                <img src="/img/cover.jpg" alt="Studio" />
              </div>
              <form className="booking-form" onSubmit={handleSubmit}>
                {[
                  { label: 'Name', name: 'name', type: 'text' },
                  { label: 'Email', name: 'email', type: 'email' },
                  { label: 'Contact Number', name: 'contact_number', type: 'tel' },
                  { label: 'Date', name: 'date', type: 'date' },
                  { label: 'Time', name: 'time', type: 'time' },
                ].map(f => (
                  <div key={f.name} className="bfield">
                    <label>{f.label}</label>
                    <input
                      type={f.type}
                      name={f.name}
                      value={form[f.name]}
                      onChange={handleChange}
                      required
                    />
                  </div>
                ))}
                <div className="bfield">
                  <label>More Details</label>
                  <textarea
                    name="comments"
                    value={form.comments}
                    onChange={handleChange}
                    placeholder="I WANT THE DESIGN..."
                    rows={3}
                  />
                </div>
                <button type="submit" className="booking-submit-btn">BOOK</button>
              </form>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default Booking;
