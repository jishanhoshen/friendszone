use dreamcre_chatapp;

drop table if exists users;
drop table if exists messages;

create table users (
    users_id int AUTO_INCREMENT PRIMARY KEY,
    unique_id int(30),
    fname varchar(50),
    lname varchar(50),
    email varchar(100),
    password varchar(50),
    img varchar(50),
    status varchar(10)
);

CREATE TABLE messages (
  msg_id int AUTO_INCREMENT PRIMARY KEY,
  incoming_msg_id int,
  outgoing_msg_id int,
  msg varchar(1000)
);


INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES 
('1588659288', 'jishan', 'hoshen', 'jishanhoshenjibon@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'jishanhoshen1588659288.jpg', 'active'),
('1368561049', 'abu', 'siddik', 'abusiddik@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'abusiddik1368561049.jpg', 'active');