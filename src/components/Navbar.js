import React, { useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import './Navbar.css';

const Navbar = () => {
  const [menuOpen, setMenuOpen] = useState(false);
  const location = useLocation();

  const navLinks = [
    { to: '/', label: 'Home' },
    { to: '/studios', label: 'Studios' },
    { to: '/login', label: 'Log In' },
    { to: '/contact', label: 'Contact' },
    { to: '/about', label: 'About' },
  ];

  return (
    <header className="navbar">
      <Link to="/" className="navbar-logo">Studio Spot</Link>
      <button
        className={`hamburger ${menuOpen ? 'open' : ''}`}
        onClick={() => setMenuOpen(!menuOpen)}
        aria-label="Menu"
      >
        {menuOpen ? '✕' : '☰'}
      </button>
      <nav className={`nav-menu ${menuOpen ? 'active' : ''}`}>
        <ul>
          {navLinks.map(({ to, label }) => (
            <li key={to}>
              <Link
                to={to}
                className={location.pathname === to ? 'active-link' : ''}
                onClick={() => setMenuOpen(false)}
              >
                {label}
              </Link>
            </li>
          ))}
        </ul>
      </nav>
      {menuOpen && <div className="nav-overlay" onClick={() => setMenuOpen(false)} />}
    </header>
  );
};

export default Navbar;
