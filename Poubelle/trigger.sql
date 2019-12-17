/*
trigger sur la table user
*/

DROP TRIGGER IF EXISTS user_role_attribue;

CREATE TRIGGER user_prix
BEFORE INSERT ON USER
FOR EACH ROW BEGIN
    IF NEW.us_role <> 'administrator' OR NEW.us_role <> 'contributor' OR NEW.us_role <> 'visitor' THEN
        INSERT INTO LOGERROR(MESSAGE) VALUES (CONCAT("ATTENTION, LE ROLE DOIT ETRE BON"));
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'LE ROLE DOIT ETRE BON';
    END IF;
END;