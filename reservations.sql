drop table if exists reservation;
drop table if exists room;

create table room 
	(
		roomNumber float,
		primary key(roomNumber)
	);

create table reservation
	(
		roomNumber float,
		startDateTime datetime,
		endDateTime datetime,
		host varchar(255),
		type varchar(255),
		active bit default 1,
		primary key(startDateTime),
 		foreign key(roomNumber) references room(roomNumber)
 	);

insert into room values (16.01);

insert into reservation values (16.01, '2018-07-11T11:00', '2018-07-11T11:30', 'Manel', 'External Meeting (high priority)', 1);
