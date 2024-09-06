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
insert into user values (null, "John");
insert into user values (null, "Rory");
insert into user values (null, "Aiden");
insert into user values (null, "Caroline");

-- DEVs
insert into dev values (null, "Unknown Developer", "The following games are added without developer information. Feel free to edit them with correct developer.");
insert into dev values (null, "CREATIVE ASSEMBLY", "The Creative Assembly Limited is a British video game developer based in Horsham, founded in 1987 by Tim Ansell. In its early years, the company worked on porting games to MS-DOS from Amiga and ZX Spectrum platforms, later working with Electronic Arts to produce a variety of games under the EA Sports brand.");
insert into dev values (null, "Klei", "Klei Entertainment Inc. is a Canadian video game development company located in Vancouver, British Columbia. Klei was formed in July 2005 by Jamie Ching Cheng. Their best-known titles include Don't Starve and Oxygen Not Included.");
insert into dev values (null, "Valve", "Valve Corporation, also known as Valve Software, is an American video game developer, publisher, and digital distribution company headquartered in Bellevue, Washington. It is the developer of the software distribution platform Steam and the game franchises Half-Life, Counter-Strike, Portal, Day of Defeat, Team Fortress, Left 4 Dead and Dota.");
insert into dev values (null, "Larian Studio", "Larian Studios is a Belgian independent video game developer and publisher founded in 1996 by Swen Vincke. Headquartered in Ghent, Belgium, Larian focuses on developing role-playing video games but has previously worked on educational games and casino games. It is best known for developing the Divinity series and Baldur's Gate 3.");

-- GAMEs
insert into game values(null, "Divinity: Original Sin", "2015-10-28", "Gather your party and get ready for the kick-ass new version of GameSpot's PC Game of the Year 2014. With hours of new content, new game modes, full voiceovers, split-screen multiplayer, and thousands of improvements, there's never been a better time to explore the epic world of Rivellon!", "RPG", "56.95", 5, 1);
insert into game values(null, "Total War: SHOGUN 2", "2011-03-15", "Total War: SHOGUN 2 is the perfect mix of real-time and turn-based strategy gaming for newcomers and veterans alike.", "Strategy, Historical", "44.99", 2, 1);
insert into game values(null, "Don't Starve Together", "2016-04-22", "Fight, Farm, Build and Explore Together in the standalone multiplayer expansion to the uncompromising wilderness survival game, Don't Starve.", "Survival, Open World", "21.50", 3, 1);
insert into game values(null, "Total War: WARHAMMER III", "2022-02-17", "The cataclysmic conclusion to the Total War: WARHAMMER trilogy is here. Rally your forces and step into the Realm of Chaos, a dimension of mind-bending horror where the very fate of the world will be decided. Will you conquer your Daemons… or command them?", "Grand Strategy", "99.99", 2, 1);
insert into game values(null, "Oxygen Not Included", "2019-07-31", "Oxygen Not Included is a space-colony simulation game. Deep inside an alien space rock your industrious crew will need to master science, overcome strange new lifeforms, and harness incredible space tech to survive, and possibly, thrive.", "Base Building", "35.95", 3, 1);
insert into game values(null, "Dota 2", "2013-07-10", "Every day, millions of players worldwide enter battle as one of over a hundred Dota heroes. And no matter if it's their 10th hour of play or 1,000th, there's always something new to discover. With regular updates that ensure a constant evolution of gameplay, features, and heroes, Dota 2 has taken on a life of its own.", "MOBA", "Free", 4, 1);
insert into game values(null, "Counter-Strike 2", "2012-08-22", "For over two decades, Counter-Strike has offered an elite competitive experience, one shaped by millions of players from across the globe. And now the next chapter in the CS story is about to begin. This is Counter-Strike 2.", "FPS", "Free", 4, 1);
insert into game values(null, "Divinity: Original Sin 2", "2017-09-14", "The critically acclaimed RPG that raised the bar, from the creators of Baldur's Gate 3. Gather your party. Master deep, tactical combat. Venture as a party of up to four - but know that only one of you will have the chance to become a God.", "RPG", "64.95", 5, 1);
insert into game values(null, "Total War: PHARAOH", "2023-10-12", "In Total War: PHARAOH, the newest entry in the award-winning grand strategy series, immerse yourself in ancient Egypt at the zenith of its power and experience the dramatic events that threaten its destruction.", "Grand Strategy", "59.99", 2, 1);
insert into game values(null, "Baldur's Gate 3", "2023-08-04", "Baldur's Gate 3 is a story-rich, party-based RPG set in the universe of Dungeons & Dragons, where your choices shape a tale of fellowship and betrayal, survival and sacrifice, and the lure of absolute power.", "RPG", "89.95", 5, 1);
insert into game values(null, "Total War: ATTILA", "2015-02-17", "Against a darkening background of famine, disease and war, a new power is rising in the great steppes of the East. With a million horsemen at his back, the ultimate warrior king approaches, and his sights are set on Rome…", "Strategy, Hisotrical", "66.99", 2, 1);
insert into game values(null, "Rotwood", "2024-04-25", "The world has been thrown into chaos, and it's up to you and your friends to battle the corrupted beasts of the Rotwood. Upgrade your gear, choose your preferred weapon, and hone your skills to defend your safe haven.", "Dungeon Crawler", "16.25", 3, 1);
insert into game values(null, "Portal 2", "2011-04-19", 'The "Perpetual Testing Initiative" has been expanded to allow you to design co-op puzzles for you and your friends!', "Platformer, First Person", "2.95", 4, 1);
insert into game values(null, "Total War: Three Kingdoms", "2019-05-24", "Total War: THREE KINGDOMS is the first in the award-winning series to recreate epic conflict across ancient China. Combining a gripping turn-based campaign of empire-building & conquest with stunning real-time battles, THREE KINGDOMS redefines the series in an age of heroes & legends.", "Strategy, Hisotrical", "89.99", 2, 1);

-- REVIEWs
-- Divinity OS
insert into review values(null, "it's alright", 6, "2016-08-22", 1, 4);
insert into review values(null, "meh", 5, "2016-08-22", 1, 5);
insert into review values(null, "I had fun", 7, "2016-08-22", 1, 3);
insert into review values(null, "good game", 9, "2016-08-22", 1, 2);

-- TW Shogun 2
insert into review values(null, "it's okay", 5, "2016-08-22", 2, 2);
insert into review values(null, "it's a game of all time", 6, "2016-08-22", 2, 4);
insert into review values(null, "pretty bad", 4, "2016-08-22", 2, 3);

-- DST
insert into review values(null, "too expensive", 4, "2016-08-22", 3, 2);
insert into review values(null, "I enjoyed it", 8, "2016-08-22", 3, 4);
insert into review values(null, "it got better", 7, "2016-08-22", 3, 3);

-- TW WH3
insert into review values(null, "masterpiece", 10, "2016-08-22", 4, 3);
insert into review values(null, "lovely", 9, "2016-08-22", 4, 5);
insert into review values(null, "love it", 9, "2016-08-22", 4, 4);

-- Oxygen Not Included
insert into review values(null, "all I ever want and more", 10, "2016-08-22", 5, 2);
insert into review values(null, "I love this game", 8, "2016-08-22", 5, 4);
insert into review values(null, "Klei does not miss", 9, "2016-08-22", 5, 5);

-- Dota
insert into review values(null, "toxic", 7, "2016-08-22", 6, 5);
insert into review values(null, "I keep coming back, help", 9, "2016-08-22", 6, 3);
insert into review values(null, "I hate u valve", 6, "2016-08-22", 6, 4);

-- CS2
insert into review values(null, "good old days", 9, "2016-08-22", 7, 2);
insert into review values(null, "miss those", 8, "2016-08-22", 7, 3);
insert into review values(null, "can you please do CS3?", 8, "2016-08-22", 7, 4);

-- Divinity OS 2
insert into review values(null, "good old days", 9, "2016-08-22", 7, 2);
insert into review values(null, "miss those", 8, "2016-08-22", 7, 3);
insert into review values(null, "can you please do CS3?", 8, "2016-08-22", 7, 4);

-- TW Pharaoh
insert into review values(null, "good old days", 9, "2016-08-22", 7, 2);
insert into review values(null, "miss those", 8, "2016-08-22", 7, 3);
insert into review values(null, "can you please do CS3?", 8, "2016-08-22", 7, 4);

-- BG3
insert into review values(null, "good old days", 9, "2016-08-22", 7, 2);
insert into review values(null, "miss those", 8, "2016-08-22", 7, 3);
insert into review values(null, "can you please do CS3?", 8, "2016-08-22", 7, 4);

-- TW Attila
insert into review values(null, "good old days", 9, "2016-08-22", 7, 2);
insert into review values(null, "miss those", 8, "2016-08-22", 7, 3);
insert into review values(null, "can you please do CS3?", 8, "2016-08-22", 7, 4);

-- Rotwood
insert into review values(null, "good old days", 9, "2016-08-22", 7, 2);
insert into review values(null, "miss those", 8, "2016-08-22", 7, 3);
insert into review values(null, "can you please do CS3?", 8, "2016-08-22", 7, 4);

-- Portal 2
insert into review values(null, "good old days", 9, "2016-08-22", 7, 2);
insert into review values(null, "miss those", 8, "2016-08-22", 7, 3);
insert into review values(null, "can you please do CS3?", 8, "2016-08-22", 7, 4);

-- TW 3K
insert into review values(null, "good old days", 9, "2016-08-22", 7, 2);
insert into review values(null, "miss those", 8, "2016-08-22", 7, 3);
insert into review values(null, "can you please do CS3?", 8, "2016-08-22", 7, 4);