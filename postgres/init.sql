CREATE TABLE IF NOT EXISTS customer
(
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT null,
    bank_account_number VARCHAR(26) NOT NULL,
    tax_id VARCHAR(10) NOT NULL UNIQUE
);
CREATE INDEX IF NOT EXISTS idx_customers_tax_id ON customer(tax_id);

CREATE TABLE IF NOT EXISTS invoice
(
    id BIGSERIAL PRIMARY KEY,
    number VARCHAR(20) NOT null,
    issue_date DATE NOT NULL,
    payment_date DATE NOT NULL,
    gross_amount NUMERIC(10, 2) NOT NULL,
    customer_fkey BIGINT REFERENCES customer(id) ON DELETE CASCADE
);
CREATE INDEX IF NOT EXISTS idx_invoice_customer_id ON invoice(customer_fkey);

CREATE TABLE IF NOT EXISTS invoice_item
(
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    quantity NUMERIC(10, 2) NOT NULL,
    price NUMERIC(10, 2) NOT NULL,
    invoice_fkey BIGINT REFERENCES invoice(id) ON DELETE CASCADE
);
CREATE INDEX IF NOT EXISTS idx_invoice_item_invoice_id ON invoice_item(invoice_fkey);


CREATE TABLE IF NOT EXISTS payment
(
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    amount NUMERIC(10, 2) NOT NULL,
    payment_date DATE NOT NULL,
    bank_account_number VARCHAR(26) NOT NULL,
    invoice_fkey INT REFERENCES invoice(id) ON DELETE SET NULL
);
CREATE INDEX IF NOT EXISTS idx_payment_invoice_id ON payment(invoice_fkey);

CREATE TABLE IF NOT EXISTS overpayment
(
    id BIGSERIAL PRIMARY KEY,
    payment_fkey INT REFERENCES payment(id) ON DELETE CASCADE,
    amount NUMERIC(10, 2) NOT NULL
);

CREATE INDEX IF NOT EXISTS idx_overpayment_payment_id ON overpayment(payment_fkey);

INSERT INTO customer (name, bank_account_number, tax_id)
VALUES
    ('Przemysław', '37114098851843363613032672', '5812812940'),
    ('Vladyslav', '02102057633790459718330947', '5812812941'),
    ('Ihor', '91184044832238365750126428', '5812812942'),
    ('Cyprian', '03124076225826921068844904', '5812812943'),
    ('Izabela', '49213038613856869343564356', '5812812944'),
    ('Romualda', '23147001292258771319834566', '5812812945'),
    ('Kalina', '08161067345053117948700037', '5812812946'),
    ('Irena', '13203094841160033265767308', '5812812947'),
    ('Wiesław', '37158016098861318102947883', '5812812948');

INSERT INTO invoice (number, issue_date, payment_date, gross_amount, customer_fkey)
VALUES
    ('INV004', '2024-10-11', '2024-11-11', 1800.50, 1),
    ('INV005', '2024-10-12', '2024-11-12', 2500.75, 2),
    ('INV006', '2024-10-13', '2024-11-13', 3050.00, 3),
    ('INV007', '2024-10-14', '2024-11-14', 4000.00, 1),
    ('INV008', '2024-10-15', '2024-11-15', 1850.30, 2),
    ('INV009', '2024-10-16', '2024-11-16', 2100.50, 3),
    ('INV010', '2024-10-17', '2024-11-17', 3500.25, 1),
    ('INV011', '2024-10-18', '2024-11-18', 1250.75, 2),
    ('INV012', '2024-10-19', '2024-11-19', 4750.00, 3),
    ('INV013', '2024-10-20', '2024-11-20', 2650.80, 1),
    ('INV014', '2024-10-21', '2024-11-21', 1325.40, 2),
    ('INV015', '2024-10-22', '2024-11-22', 920.25, 3),
    ('INV016', '2024-10-23', '2024-11-23', 5400.75, 1),
    ('INV017', '2024-10-24', '2024-11-24', 2100.00, 2),
    ('INV018', '2024-10-25', '2024-11-25', 4900.50, 3),
    ('INV019', '2024-10-26', '2024-11-26', 3325.20, 1),
    ('INV020', '2024-10-27', '2024-11-27', 3100.00, 2),
    ('INV021', '2024-10-28', '2024-11-28', 2250.50, 3),
    ('INV022', '2024-10-29', '2024-11-29', 1850.75, 1),
    ('INV023', '2024-10-30', '2024-11-30', 2990.90, 2),
    ('INV024', '2024-10-30', '2024-11-30', 1850.45, 3),
    ('INV025', '2024-11-01', '2024-12-01', 1750.55, 1),
    ('INV026', '2024-11-02', '2024-12-02', 3890.40, 2),
    ('INV027', '2024-11-03', '2024-12-03', 2900.30, 3),
    ('INV028', '2024-11-04', '2024-12-04', 2150.70, 1),
    ('INV029', '2024-11-05', '2024-12-05', 1230.60, 2),
    ('INV030', '2024-11-06', '2024-12-06', 3240.25, 3),
    ('INV031', '2024-11-07', '2024-12-07', 4100.50, 1),
    ('INV032', '2024-11-08', '2024-12-08', 950.00, 2),
    ('INV033', '2024-11-09', '2024-12-09', 2900.00, 3),
    ('INV034', '2024-11-10', '2024-12-10', 3100.75, 1),
    ('INV035', '2024-11-11', '2024-12-11', 1425.30, 2),
    ('INV036', '2024-11-12', '2024-12-12', 2780.50, 3),
    ('INV037', '2024-11-13', '2024-12-13', 3300.00, 1),
    ('INV038', '2024-11-14', '2024-12-14', 1950.40, 2),
    ('INV039', '2024-11-15', '2024-12-15', 4900.25, 3),
    ('INV040', '2024-11-16', '2024-12-16', 2500.75, 1),
    ('INV041', '2024-11-17', '2024-12-17', 1950.00, 2),
    ('INV042', '2024-11-18', '2024-12-18', 2850.50, 3),
    ('INV043', '2024-11-19', '2024-12-19', 4200.30, 1),
    ('INV044', '2024-11-20', '2024-12-20', 3100.75, 2),
    ('INV045', '2024-11-21', '2024-12-21', 2200.60, 3),
    ('INV046', '2024-11-22', '2024-12-22', 3100.40, 1),
    ('INV047', '2024-11-23', '2024-12-23', 1800.25, 2),
    ('INV048', '2024-11-24', '2024-12-24', 2850.75, 3),
    ('INV049', '2024-11-25', '2024-12-25', 1950.00, 1),
    ('INV050', '2024-11-26', '2024-12-26', 2500.90, 2),
    ('INV051', '2024-11-27', '2024-12-27', 2150.75, 3),
    ('INV052', '2024-11-28', '2024-12-28', 2950.65, 1),
    ('INV053', '2024-11-29', '2024-12-29', 2400.30, 2);

INSERT INTO invoice_item (name, quantity, price, invoice_fkey)
VALUES
    ('Product A', 3, 600.00, 4),
    ('Service B', 1, 1000.50, 4),
    ('Consulting C', 2, 1250.38, 5),
    ('Product D', 10, 125.50, 5),
    ('Software E', 1, 3050.00, 6),
    ('Product F', 4, 1000.00, 7),
    ('Hardware G', 5, 370.06, 8),
    ('Service H', 2, 1050.25, 9),
    ('Product I', 7, 500.00, 10),
    ('Service J', 3, 416.92, 11),
    ('Product K', 1, 4750.00, 12),
    ('Service L', 4, 662.70, 13),
    ('Product M', 2, 420.00, 14),
    ('Service N', 5, 185.50, 15),
    ('Product O', 6, 900.00, 16),
    ('Service P', 3, 700.00, 17),
    ('Product Q', 2, 950.50, 18),
    ('Service R', 1, 4900.50, 19),
    ('Product S', 3, 1108.40, 20),
    ('Product T', 5, 250.50, 21),
    ('Service U', 1, 2900.00, 22),
    ('Product V', 2, 925.23, 23),
    ('Service W', 4, 275.50, 24),
    ('Product X', 7, 165.00, 25),
    ('Service Y', 2, 1950.00, 26),
    ('Product Z', 5, 780.50, 27),
    ('Service AA', 1, 2150.70, 28),
    ('Product AB', 2, 615.30, 29),
    ('Service AC', 4, 1200.00, 30),
    ('Product AD', 3, 1366.75, 31),
    ('Service AE', 1, 1425.30, 32),
    ('Product AF', 4, 710.50, 33),
    ('Service AG', 2, 1250.00, 34),
    ('Product AH', 5, 660.25, 35),
    ('Service AI', 3, 2200.00, 36),
    ('Product AJ', 1, 2500.75, 37),
    ('Service AK', 1, 1950.40, 38),
    ('Product AL', 2, 3450.12, 39),
    ('Service AM', 3, 1500.00, 40),
    ('Product AN', 2, 490.50, 41),
    ('Service AO', 1, 2850.50, 42),
    ('Product AP', 6, 400.00, 43),
    ('Service AQ', 1, 3100.40, 44),
    ('Product AR', 2, 900.00, 45),
    ('Service AS', 3, 1800.25, 46),
    ('Product AT', 4, 460.15, 47),
    ('Service AU', 5, 1950.00, 48),
    ('Product AV', 3, 1200.90, 49),
    ('Service AW', 1, 2150.75, 50);

INSERT INTO payment (title, amount, payment_date, bank_account_number, invoice_fkey)
VALUES
    ('Payment for INV004', 1800.50, '2024-10-20', '12345678901234567890123456', 4),
    ('Partial payment for INV005', 2000.00, '2024-10-21', '23456789012345678901234567', 5),
    ('Remaining payment for INV005', 500.75, '2024-10-25', '23456789012345678901234567', 5),
    ('Payment for INV006', 3050.00, '2024-10-22', '34567890123456789012345678', 6),
    ('Payment for INV007', 4000.00, '2024-10-23', '12345678901234567890123456', 7),
    ('Payment for INV008', 1850.30, '2024-10-24', '23456789012345678901234567', 8),
    ('Payment for INV009', 2100.50, '2024-10-25', '34567890123456789012345678', 9),
    ('Payment for INV010', 3500.25, '2024-10-26', '12345678901234567890123456', 10),
    ('Partial payment for INV011', 1000.00, '2024-10-27', '23456789012345678901234567', 11),
    ('Remaining payment for INV011', 250.75, '2024-10-28', '23456789012345678901234567', 11),
    ('Payment for INV012', 4750.00, '2024-10-29', '34567890123456789012345678', 12),
    ('Payment for INV013', 2650.80, '2024-10-30', '12345678901234567890123456', 13),
    ('Payment for INV014', 1325.40, '2024-10-31', '23456789012345678901234567', 14),
    ('Payment for INV015', 920.25, '2024-11-01', '34567890123456789012345678', 15),
    ('Payment for INV016', 5400.75, '2024-11-02', '12345678901234567890123456', 16),
    ('Payment for INV017', 2100.00, '2024-11-03', '23456789012345678901234567', 17),
    ('Payment for INV018', 4900.50, '2024-11-04', '34567890123456789012345678', 18),
    ('Payment for INV019', 3325.20, '2024-11-05', '12345678901234567890123456', 19),
    ('Payment for INV020', 3100.00, '2024-11-06', '23456789012345678901234567', 20),
    ('Payment for INV021', 2250.50, '2024-11-07', '34567890123456789012345678', 21),
    ('Payment for INV022', 1850.75, '2024-11-08', '12345678901234567890123456', 22),
    ('Payment for INV023', 2990.90, '2024-11-09', '23456789012345678901234567', 23),
    ('Payment for INV024', 1850.45, '2024-11-10', '34567890123456789012345678', 24),
    ('Payment for INV025', 1750.55, '2024-11-11', '12345678901234567890123456', 25),
    ('Payment for INV026', 3890.40, '2024-11-12', '23456789012345678901234567', 26),
    ('Payment for INV027', 2900.30, '2024-11-13', '34567890123456789012345678', 27),
    ('Payment for INV028', 2150.70, '2024-11-14', '12345678901234567890123456', 28),
    ('Payment for INV029', 1230.60, '2024-11-15', '23456789012345678901234567', 29),
    ('Payment for INV030', 3240.25, '2024-11-16', '34567890123456789012345678', 30);

INSERT INTO overpayment (payment_fkey, amount)
VALUES
    (2, 200.00),
    (5, 50.30),
    (9, 100.75),
    (12, 20.25),
    (18, 300.00),
    (24, 50.55),
    (29, 140.25),
    (22, 200.75),
    (26, 150.40),
    (16, 100.90);
