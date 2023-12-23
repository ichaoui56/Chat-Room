create table user
(
    user_id  bigint auto_increment primary key,
    email    varchar(255) not null,
    password text not null,
    username varchar(255) null,
    picture  text null,
    constraint user_users_email_uindex unique (email),
    constraint user_user_id_uindex unique (user_id)
);

create table room
(
    room_id    bigint auto_increment primary key,
    room_name  varchar(255) not null,
    creator    bigint,
    is_deleted TINYINT(1) DEFAULT 0,
    FOREIGN KEY (creator) REFERENCES user (user_id)
);

create table message
(
    message_id bigint auto_increment primary key,
    message    text,
    room_id    bigint,
    user_id    bigint,
    date       text,
    foreign key (room_id) REFERENCES room(room_id),
    foreign key (user_id) REFERENCES user (user_id)
);

create table room_invitation
(
    invitation_id bigint auto_increment primary key,
    room_id       bigint,
    sender        bigint,
    receiver      bigint,
    checker       TINYINT(1) DEFAULT 0,
    foreign key (room_id) REFERENCES room(room_id),
    foreign key (sender) REFERENCES user (user_id),
    foreign key (receiver) REFERENCES user (user_id)
);

create table room_member
(
    room_id bigint,
    user_id bigint,
    banned  TINYINT(1) DEFAULT 0,
    foreign key (room_id) REFERENCES room(room_id),
    foreign key (user_id) REFERENCES user (user_id)
);

create table friend_list
(
    me            bigint,
    myfriend      bigint,
    block_checker TINYINT(1) DEFAULT 0,
    foreign key (me) REFERENCES user (user_id),
    foreign key (myfriend) REFERENCES user (user_id)
);

create table friend_request
(
    invitation_id bigint auto_increment primary key,
    sender        bigint,
    receiver      bigint,
    checker       TINYINT(1) DEFAULT 0,
    foreign key (sender) REFERENCES user (user_id),
    foreign key (receiver) REFERENCES user (user_id)
);