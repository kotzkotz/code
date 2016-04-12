CREATE VIEW Student(Sno,Sname,Ssex,Sage,Sdept)
AS
SELECT SX.Sno,SX.Sname,SY.Ssex,SX.Sage,SY.Sdept
FROM SX,SY
WHERE SX.Sno=SY.Sno;


CREATE VIEW test2(id,name,password,email)
AS
SELECT user.uid,yld.name,yld.password,user.email
FROM user,yld
WHERE user.uid=yld.id;

DROP VIEW  `test2`;