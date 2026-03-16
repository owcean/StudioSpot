import React from 'react';
import { Link } from 'react-router-dom';
import Navbar from '../components/Navbar';
import Footer from '../components/Footer';
import './Home.css';

const Home = () => (
  <div className="home">
    <Navbar />
    <section
      className="hero"
      style={{ backgroundImage: `url(${process.env.PUBLIC_URL}/img/cover.jpg)` }}
    >
      <div className="hero-overlay" />
      <div className="hero-content">
        <h1 className="hero-title">Your Studio,<br />Your Story.</h1>
        <div className="hero-line" />
        <Link to="/login" className="hero-btn">LOG IN / SIGN UP</Link>
      </div>
    </section>
    <Footer />
  </div>
);

export default Home;
