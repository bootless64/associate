
CREATE DATabase university
use university go 


use university 
go 
create table department
(
deid char(10)  not null  primary key,
detitle char(10) not null ,
dephone char(10) not null );
insert into department
values('d1','computer','1111')
insert into department
values('d2','electronic','1122')
insert into department
values('d3','omran','1133')
insert into department
values('d4','sazeh','1144')
insert into department
values('d5','varzesh','1155')
insert into department
values('d6','mecanic','1166')
insert into department
values('d7','it','1177' )


create table student
(
stid char(10) not null primary key ,
stname char(10) not null,
stlevel char(10) not null,
stmjr char(10) ,
deid char(10) ,
check(stlevel='bs' or stlevel='ms' or stlevel='phd'),
foreign key(deid) references department(deid)
on delete cascade
on update cascade
);
insert into student
values('1400123','reza zadeh','ms','computer','d1')
insert into student
values('1400124','hasani','ms','computer','d1')
insert into student
values('1400125','mohammadi','bs','computer','d1')
insert into student
values('1400126','saeidi','ms','mecanic','d6')
insert into student
values('1400127','hashemi','ms','varzesh','d5')
insert into student
values('1400128','khatami','bs','computer','d1')
insert into student
values('1400129','hatami','bs','it','d7')
insert into student
values('1400130','saberi','ms','varzesh','d5')
insert into student
values('1400131','khabaz','ms','computer','d1')
insert into student
values('1400132','koohestani','phd','computer','d1')
insert into student
values('1400133','rahmani','ms','it','d7')
insert into student
values('1400134','rahimi','ms','sazeh','d4')
insert into student
values('1400136','mardani','ms','omran','d3')
insert into student
values('1400135','moradzadeh','ms','sazeh','d4')
insert into student
values('1400137','hasanzadeh','ms','electronic','d2')
insert into student
values('1400138','dehaki','phd','computer','d1')


create table course
(
coid char(10) not null primary key ,
cotitle char(10) not null,
credit char(10) ,
cotype char(10) ,
deid char(10) ,
foreign key(deid) references department(deid)
on delete cascade
on update cascade
);
insert into course
values('11111','az payegah','2','p','d1')
insert into course
values('11321','payegah','2','t','d1')
insert into course
values('11331','python','3','t','d1')
insert into course
values('11344','madar','2','t','d2')
insert into course
values('11398','electronic','3','t','d2')
insert into course
values('11345','electronic','3','t','d6')
insert into course
values('11309','valibal','2','p','d5')
insert into course
values('11376','sakhteman','3','t','d4')
insert into course
values('11365','omran','3','t','d3')


create table professor
(
prid char(10) not null primary key ,
pname char(10) not null,
prank char(10) ,
pfrom char(4) ,
deid char(10) ,
foreign key(deid) references department(deid)
on delete cascade
on update cascade
);
insert into professor
values('11133','mohamadi','phd','1390','d1')
insert into professor
values('11144','hamidzadeh','phd','1380','d1')
insert into professor
values('11155','bagheri','phd','1400','d6')
insert into professor
values('11166','noori','phd','1390','d2')
insert into professor
values('11177','hamidi','phd','1388','d3')
insert into professor
values('11188','hayati','phd','1395','d5')
insert into professor
values('11199','rahimi','phd','1401','d4')


create table scpt
(
stid char(10) not null ,
coid char(10) not null,
prid char(10) not null,
tr char(4) ,
yr char(4) ,
primary key(stid,coid,prid),
grade decimal(4,2),
foreign key(stid) references student(stid)
on delete NO ACTION
on update NO ACTION,
foreign key(coid) references course(coid)
on delete NO ACTION
on update NO ACTION,
foreign key(prid) references professor(prid)
on delete NO ACTION
on update NO ACTION
);
insert into scpt
values('1400123','11111','11133','1', '1402',' 20.00')
insert into scpt
values('1400124','11331','11144','1', '1390',' 20.00')
insert into scpt
values('1400125','11331','11144','2', '1402',' 18.75')
insert into scpt
values('1400136','11365','11177','1', '1402',' 15.25')
insert into scpt
values('1400137','11345','11166','1', '1402',' 19.30')

INSERT INTO student (stid, stname, stlevel, stmjr, deid)
VALUES
    ('1400123', 'reza zadeh', 'ms', 'computer', 'd1'),
    ('1400124', 'hasani', 'ms', 'computer', 'd1'),
    ('1400125', 'mohammadi', 'bs', 'computer', 'd1'),
    ('1400126', 'saeidi', 'ms', 'mecanic', 'd6'),
    ('1400127', 'hashemi', 'ms', 'varzesh', 'd5'),
    ('1400128', 'khatami', 'bs', 'computer', 'd1'),
    ('1400129', 'hatami', 'bs', 'it', 'd7'),
    ('1400130', 'saberi', 'ms', 'varzesh', 'd5'),
    ('1400131', 'khabaz', 'ms', 'computer', 'd1'),
    ('1400132', 'koohestani', 'phd', 'computer', 'd1'),
    ('1400133', 'rahmani', 'ms', 'it', 'd7'),
    ('1400134', 'rahimi', 'ms', 'sazeh', 'd4'),
    ('1400136', 'mardani', 'ms', 'omran', 'd3'),
    ('1400135', 'moradzadeh', 'ms', 'sazeh', 'd4'),
    ('1400137', 'hasanzadeh', 'ms', 'electronic', 'd2'),
    ('1400138', 'dehaki', 'phd', 'computer', 'd1');

