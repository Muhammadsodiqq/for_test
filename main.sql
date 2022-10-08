CREATE TABLE persons
(
    id         int          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name  VARCHAR(255) NOT NULL,
    email      VARCHAR(255) NOT NULL,
    birth_date DATE         NOT NULL,
    status     TINYINT      NOT NULL COMMENT '0-unactive,1-active'
);

DELIMITER $$
CREATE PROCEDURE generate_data()
BEGIN
    DECLARE i INT DEFAULT 0;
    WHILE i < 100
        DO
            INSERT INTO `persons` (`first_name`, `last_name`, `email`, `birth_date`, `status`)
            VALUES (CONV(FLOOR(RAND() * 99999999999999), 10, 36),
                    CONV(FLOOR(RAND() * 99999999999999), 10, 36),
                    CONCAT(uuid_short(), '@gmail.com'),
                    CONCAT('2020-', floor(RAND() * (10 - 1) + 1), '-', floor(RAND() * (10 - 1) + 1)),
                    floor(RAND() * (2 - 0) + 0));
            SET i = i + 1;
        END WHILE;
END$$
DELIMITER ;

CALL generate_data();