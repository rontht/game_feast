drop table if exists user;
create table user (
    id integer not null primary key autoincrement,
    name varchar(20) not null unique
    -- user_image try add this one
);

drop table if exists dev;
create table dev (
    id integer not null primary key autoincrement,
    name varchar(20) not null,
    about text default ''
    -- dev_image try add this one
);

drop table if exists game;
create table game (
    id integer not null primary key autoincrement,
    name varchar(20)  not null,
    release_date date,
    about text default '',
    tag text default '',
    price varchar(10),
    dev_id integer not null references dev(id),
    user_id integer not null references user(id)
);

drop table if exists review;
create table review (
    id integer not null primary key autoincrement,
    comment text default '',
    rating integer,
    posted_on date,
    game_id integer not null references game(id),
    user_id integer not null references user(id)
);

-- USERs
insert into user values (null, "anonymous");
insert into user values (null, "reviewer 1");
insert into user values (null, "reviewer 2");
insert into user values (null, "reviewer 3");

-- DEVs
insert into dev values (null, "CREATIVE ASSEMBLY", "dev description");
insert into dev values (null, "Klei", "dev description");
insert into dev values (null, "Valve", "dev description");

-- GAMEs
insert into game values(null, "Total War: SHOGUN 2", "2011-03-15", "game description", "Grand Strategy", "$44.99", 1, 1);
insert into game values(null, "Total War: PHARAOH", "2023-10-12", "game description", "Grand Strategy", "$59.99", 1, 1);
insert into game values(null, "Total War: WARHAMMER III", "2022-02-17", "game description", "Grand Strategy", "$99.99", 1, 1);
insert into game values(null, "Don't Starve Together", "2016-04-22", "game description", "Survival", "$21.50", 2, 1);
insert into game values(null, "Oxygen Not Included", "2019-07-31", "game description", "Base Building", "$35.95", 2, 1);
insert into game values(null, "Dota 2", "2013-07-10", "game description", "MOBA", "Free", 3, 1);
insert into game values(null, "Counter-Strike 2", "2012-08-22", "game description", "FPS", "Free", 3, 1);

-- REVIEWs

insert into review values(null, "good game", 9, "2016-08-22", 1, 2);
insert into review values(null, "I had fun", 7, "2016-08-22", 1, 3);
insert into review values(null, "it's alright", 6, "2016-08-22", 1, 3);
insert into review values(null, "meh", 5, "2016-08-22", 1, 4);

insert into review values(null, "it's okay", 5, "2016-08-22", 2, 2);
insert into review values(null, "pretty bad", 4, "2016-08-22", 2, 3);
insert into review values(null, "it's a game of all time", 6, "2016-08-22", 2, 4);

insert into review values(null, "too expensive", 4, "2016-08-22", 3, 2);
insert into review values(null, "it got better", 7, "2016-08-22", 3, 3);
insert into review values(null, "I enjoyed it", 8, "2016-08-22", 3, 4);

insert into review values(null, "lovely", 9, "2016-08-22", 4, 2);
insert into review values(null, "masterpiece", 10, "2016-08-22", 4, 3);
insert into review values(null, "love it", 9, "2016-08-22", 4, 4);

insert into review values(null, "Klei does not miss", 9, "2016-08-22", 5, 2);
insert into review values(null, "all I ever want and more", 10, "2016-08-22", 5, 3);
insert into review values(null, "I love this game", 8, "2016-08-22", 5, 4);

insert into review values(null, "toxic", 7, "2016-08-22", 6, 2);
insert into review values(null, "I keep coming back, help", 9, "2016-08-22", 6, 3);
insert into review values(null, "I hate u valve", 6, "2016-08-22", 6, 4);

insert into review values(null, "good old days", 9, "2016-08-22", 7, 2);
insert into review values(null, "miss those", 8, "2016-08-22", 7, 3);
insert into review values(null, "can you please do CS3?", 8, "2016-08-22", 7, 4);