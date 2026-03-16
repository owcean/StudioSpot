import React from 'react';
import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import { AuthProvider } from './context/AuthContext';
import ProtectedRoute from './components/ProtectedRoute';

import Home from './pages/Home';
import Login from './pages/Login';
import Register from './pages/Register';
import Studios from './pages/Studios';
import About from './pages/About';
import Contact from './pages/Contact';

import UserDashboard from './pages/UserDashboard';
import StudioListings from './pages/StudioListings';
import StudioDetail from './pages/StudioDetail';
import Booking from './pages/Booking';
import UserProfile from './pages/UserProfile';

import AdminDashboard from './pages/AdminDashboard';
import AdminSchedule from './pages/AdminSchedule';
import AdminProfile from './pages/AdminProfile';

import './App.css';

function App() {
  return (
    <AuthProvider>
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/login" element={<Login />} />
          <Route path="/register" element={<Register />} />
          <Route path="/studios" element={<Studios />} />
          <Route path="/about" element={<About />} />
          <Route path="/contact" element={<Contact />} />

          <Route path="/dashboard" element={<ProtectedRoute><UserDashboard /></ProtectedRoute>} />
          <Route path="/dashboard/studios" element={<ProtectedRoute><StudioListings /></ProtectedRoute>} />
          <Route path="/dashboard/minimalist" element={<ProtectedRoute><StudioDetail studioKey="minimalist" /></ProtectedRoute>} />
          <Route path="/dashboard/boho" element={<ProtectedRoute><StudioDetail studioKey="boho" /></ProtectedRoute>} />
          <Route path="/dashboard/corpo" element={<ProtectedRoute><StudioDetail studioKey="corpo" /></ProtectedRoute>} />
          <Route path="/dashboard/custom" element={<ProtectedRoute><StudioDetail studioKey="custom" /></ProtectedRoute>} />
          <Route path="/dashboard/booking" element={<ProtectedRoute><Booking /></ProtectedRoute>} />
          <Route path="/dashboard/profile" element={<ProtectedRoute><UserProfile /></ProtectedRoute>} />

          <Route path="/admin" element={<ProtectedRoute requiredRole="admin"><AdminDashboard /></ProtectedRoute>} />
          <Route path="/admin/schedule" element={<ProtectedRoute requiredRole="admin"><AdminSchedule /></ProtectedRoute>} />
          <Route path="/admin/profile" element={<ProtectedRoute requiredRole="admin"><AdminProfile /></ProtectedRoute>} />

          <Route path="*" element={<Navigate to="/" replace />} />
        </Routes>
      </BrowserRouter>
    </AuthProvider>
  );
}

export default App;
