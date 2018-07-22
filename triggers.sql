DROP TRIGGER if exists DateConditions_up;
DROP TRIGGER if exists DateConditions_ins;

DELIMITER $$
CREATE TRIGGER DateConditions_up BEFORE UPDATE ON display.reservation 
FOR EACH 
ROW
BEGIN
	IF new.startDateTime > new.endDateTime THEN
		signal sqlstate "45000" set message_text = "Start Date must be before End Date!";
    ELSEIF new.startDateTime < NOW() THEN
		signal sqlstate "45000" set message_text = "The meeting must start after the current time!";
	ELSEIF EXISTS(
        SELECT * FROM display.reservation
        	WHERE roomNumber = new.roomNumber
        	AND new.startDateTime BETWEEN startDateTime AND endDateTime
			OR new.endDateTime BETWEEN startDateTime AND endDateTime
    ) THEN signal sqlstate "45000" set message_text = "Another meeting already takes place during some of the specified period of time!";	    
	END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER DateConditions_ins BEFORE INSERT ON display.reservation 
FOR EACH 
ROW
BEGIN
	IF new.startDateTime > new.endDateTime THEN
		signal sqlstate "45000" set message_text = "Start Date must be before End Date!";
    ELSEIF new.startDateTime < NOW() THEN
		signal sqlstate "45000" set message_text = "The meeting must start after the current time!";
	ELSEIF EXISTS(
        SELECT * FROM display.reservation
        	WHERE roomNumber = new.roomNumber
        	AND new.startDateTime BETWEEN startDateTime AND endDateTime
			OR new.endDateTime BETWEEN startDateTime AND endDateTime
    ) THEN signal sqlstate "45000" set message_text = "Another meeting already takes place during some of the specified period of time!";	    
	END IF;
END $$
DELIMITER ;