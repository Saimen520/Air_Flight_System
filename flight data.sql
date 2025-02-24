    
CREATE TABLE cities (
    id VARCHAR(36) PRIMARY KEY,  
    city_name VARCHAR(100) NOT NULL
);

CREATE TABLE route_prices (
    id VARCHAR(36) PRIMARY KEY,  
    departure_city VARCHAR(100) NOT NULL,
    destination_city VARCHAR(100) NOT NULL,
    class_type ENUM('Economy', 'Business') NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);


CREATE TABLE flights (
    id VARCHAR(36) PRIMARY KEY, 
    departure_city VARCHAR(100) NOT NULL,  
    destination_city VARCHAR(100) NOT NULL,  
    flight_name VARCHAR(100) NOT NULL,
    departure_time TIME NOT NULL,
    arrival_time TIME NOT NULL,
    flight_date DATE NOT NULL
);


CREATE TABLE bookings ( 
    flight_id VARCHAR(36) NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    identification_card VARCHAR(20) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    class_type ENUM('Economy', 'Business') NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (flight_id) REFERENCES flights(id)
);


CREATE TABLE booking_history ( 
    flight_id VARCHAR(36) NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    identification_card VARCHAR(20) NOT NULL,
    class_type ENUM('Economy', 'Business') NOT NULL,
    email VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    payment_amount DECIMAL(10, 2) NOT NULL,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (flight_id) REFERENCES flights(id)
);