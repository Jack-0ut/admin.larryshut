CREATE TABLE rooms (
  id INT AUTO_INCREMENT PRIMARY KEY,
  room_number INT NOT NULL,
  room_type VARCHAR(50) NOT NULL,
  room_description TEXT,
  price DECIMAL(10,2) NOT NULL CHECK (price >= 0)
);

CREATE TABLE services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  price DECIMAL(10,2)
);

CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  room_id INT NOT NULL REFERENCES rooms(id),
  guest_name VARCHAR(100) NOT NULL,
  guest_email VARCHAR(255) NOT NULL,
  checkin_date DATE NOT NULL,
  checkout_date DATE NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  booking_date DATE
);

ALTER TABLE bookings
ADD CONSTRAINT checkin_before_checkout CHECK (checkin_date < checkout_date);

CREATE TABLE room_images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  room_id INT REFERENCES rooms(id),
  image_url TEXT NOT NULL
);

CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  admin_name VARCHAR(255) NOT NULL,
  admin_email VARCHAR(255) NOT NULL UNIQUE,
  admin_phone VARCHAR(20) NOT NULL UNIQUE,
  admin_password VARCHAR(255) NOT NULL
);