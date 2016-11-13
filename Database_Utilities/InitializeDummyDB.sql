/* populate STUDENT table*/
INSERT INTO STUDENT (EID, firstName, lastName, studentNetID)
VALUES ('11111111', 'William', 'Gillespie', 'wgilles2');

INSERT INTO STUDENT (EID, firstName, lastName, studentNetID)
VALUES ('11111112', 'Christina', 'Spalding', 'cspalding4');

INSERT INTO STUDENT (EID, firstName, lastName, studentNetID)
VALUES ('11111113', 'Cameron', 'Copland', 'ccopland3');

INSERT INTO STUDENT (EID, firstName, lastName, studentNetID)
VALUES ('11111114', 'John', 'Davis', 'jdavis10');

/* populate ADVISOR table */
INSERT INTO ADVISOR (advisorID, firstName, lastName, isAdmin, hashedPassword)
VALUES ('knara', 'Krish', 'Narayanan', 0,'1234');

INSERT INTO ADVISOR (advisorID, firstName, lastName, isAdmin, hashedPassword)
VALUES ('wsverdlik', 'William', 'Sverdlik', 0, '12345');

INSERT INTO ADVISOR (advisorID, firstName, lastName, isAdmin, hashedPassword)
VALUES ('bross', 'Bob', 'Ross', 1, '1234');
