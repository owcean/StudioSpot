import React, { useState } from 'react';
import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import './Contact.css';

const Contact = () => {
  const [form, setForm] = useState({ name: '', email: '', message: '' });
  const [sent, setSent] = useState(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    // In a real app, POST to backend here
    setSent(true);
    setForm({ name: '', email: '', message: '' });
  };

  return (
    <div className="contact-page">
      <Navbar />
      <main className="contact-main">
        <div className="contact-left">
          <img src="/img/cover2.png" alt="Studio Spot" className="contact-hero-img" />
        </div>

        <div className="contact-form-box">
          <h2>Contact Us</h2>
          {sent && <p className="contact-success">Message sent! We'll be in touch soon.</p>}
          <form onSubmit={handleSubmit}>
            <div className="contact-field">
              <label>Name</label>
              <input
                type="text"
                value={form.name}
                onChange={e => setForm({ ...form, name: e.target.value })}
                required
              />
            </div>
            <div className="contact-field">
              <label>Email</label>
              <input
                type="email"
                value={form.email}
                onChange={e => setForm({ ...form, email: e.target.value })}
                required
              />
            </div>
            <div className="contact-field">
              <label>Message</label>
              <textarea
                value={form.message}
                onChange={e => setForm({ ...form, message: e.target.value })}
                rows={4}
                required
              />
            </div>
            <button type="submit" className="contact-send-btn">SEND</button>
          </form>
        </div>

        <div className="contact-info-box">
          <p>Angeles City, 12345</p>
          <p>(02) 456-7890</p>
          <p><a href="mailto:StudioSpot@gmail.com">StudioSpot@gmail.com</a></p>
          <hr />
          <h3>Business Hours</h3>
          <p>Monday to Friday<br />9:00 am – 6:00 pm</p>
          <p>Saturday<br />9:00 am – 12:00 noon</p>
          <hr />
          <h3>Get Social</h3>
          <div className="social-icons">
            <a href="#"><img src="/img/fb.png" alt="Facebook" /></a>
            <a href="#"><img src="/img/tt.png" alt="Twitter" /></a>
            <a href="#"><img src="/img/ig.png" alt="Instagram" /></a>
          </div>
        </div>
      </main>
      <Footer />
    </div>
  );
};

export default Contact;
