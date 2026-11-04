
create table Department (
    DEID CHAR(10) NOT NULL PRIMARY KEY,
    DETITLE VARCHAR(100)
);

create table student (
    STID CHAR(10) NOT NULL PRIMARY KEY,
    STNAME VARCHAR(100),
    STLEVEL VARCHAR(100),
    STMAJOR VARCHAR(100),
    DEID CHAR(10),
    FOREIGN KEY (DEID) REFERENCES Department (DEID)
);

create table Course (
    CID CHAR(10) NOT NULL PRIMARY KEY,
    CTITLE VARCHAR(100),
    CREDIT INT,
    CRTYPE CHAR(1),
    DEID CHAR(10),
    FOREIGN KEY (DEID) REFERENCES Department (DEID)
);

create table Profsor (
    PRID CHAR(10) NOT NULL PRIMARY KEY,
    PNAME VARCHAR(50),
    PRANK VARCHAR(50),
    DEID CHAR(10),
    FOREIGN KEY (DEID) REFERENCES Department (DEID)
);

create table SCPT (
    STID CHAR(10),
    CID CHAR(10),
    PRID CHAR(10),
    TR CHAR(10),
    YR CHAR(10),
    GRADE DECIMAL(4,2),
    PRIMARY KEY(STID, CID, PRID, YR, TR),
    FOREIGN KEY (STID) REFERENCES student (STID),
    FOREIGN KEY (CID) REFERENCES Course (CID),
    FOREIGN KEY (PRID) REFERENCES Profsor (PRID)
);

SELECT * FROM Course;
SELECT * FROM student;
SELECT * FROM Profsor;
SELECT * FROM Department;
SELECT * FROM SCPT;
