CREATE TABLE employees (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    rfid_tag TEXT UNIQUE NOT NULL,  -- RFID badge ID
    position TEXT,
    department TEXT
);


CREATE TABLE attendance (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    employee_id INTEGER,
    clock_in DATETIME,
    clock_out DATETIME,
    hours_worked REAL,  -- Calculated field: hours between clock_in and clock_out
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

CREATE TABLE attendance (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    clock_in DATETIME,
    clock_out DATETIME,
    hours_worked REAL,
);


CREATE TABLE payroll (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    employee_id INTEGER,
    month TEXT,
    total_hours REAL,
    salary REAL,  -- Example salary calculation based on hours worked
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);

