import React from 'react';
import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import './About.css';

const About = () => (
  <div className="about-page">
    <Navbar />
    <main className="about-container">
      <h1>About Us</h1>

      <div className="about-card">
        <h2>Welcome to Studio Spot</h2>
        <p>
          Welcome to Studio Spot, your creative space in Angeles City! Designed for photographers,
          content creators, and brands, our studio offers a professional yet cozy environment where
          your ideas come to life.
        </p>
      </div>

      <div className="about-card">
        <h2>Why Choose Us?</h2>
        <ul>
          <li><strong>Diverse Themed Rooms</strong> – From minimalist aesthetics to vibrant setups, we offer multiple styles to fit your creative needs.</li>
          <li><strong>Customizable Spaces</strong> – Adjust backdrops, props, and lighting to create your ideal setting.</li>
          <li><strong>Prime Location</strong> – Conveniently located in Angeles City, with easy access and parking.</li>
          <li><strong>For Every Creator</strong> – Whether you're a professional photographer, influencer, or brand, our space is designed to inspire.</li>
        </ul>
      </div>

      <div className="about-card">
        <h2>Let's Create Together!</h2>
        <p>Every great photo tells a story — let Studio Spot be the place where you create yours.</p>
        <p><strong>Book Your Session:</strong> <a href="mailto:StudioSpot@gmail.com">StudioSpot@gmail.com</a></p>
        <p><strong>Visit Us:</strong> Angeles City</p>
        <p><strong>Follow Us:</strong> @STUDIOSPOT.PH</p>
      </div>
    </main>
    <Footer />
  </div>
);

export default About;
