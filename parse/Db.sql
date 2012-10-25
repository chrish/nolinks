CREATE TABLE nolinks(
	pageid int primary key auto_increment not null, 
	pagetitle varbinary(255), 
	checked tinyint default 0,
	pagelen long,
	numlinks int default 0
);
