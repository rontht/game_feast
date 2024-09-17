drop table if exists user;
create table user (
    id integer not null primary key autoincrement,
    name varchar(20) not null unique
);

drop table if exists dev;
create table dev (
    id integer not null primary key autoincrement,
    name varchar(20) not null unique,
    about text default ''
);

drop table if exists game;
create table game (
    id integer not null primary key autoincrement,
    name varchar(20)  not null,
    release_date date not null,
    about text default '',
    tag text not null,
    price varchar(10) default 'Free',
    dev_id integer not null references dev(id),
    user_id integer not null references user(id)
);

drop table if exists review;
create table review (
    id integer not null primary key autoincrement,
    posted_on date not null,
    comment text not null,
    rating integer,
    game_id integer not null references game(id),
    user_id integer not null references user(id)
);

-- USERs
insert into user values (null, "anonymous");
insert into user values (null, "John");
insert into user values (null, "Rory");
insert into user values (null, "Aiden");
insert into user values (null, "Caroline");
insert into user values (null, "Georgie");

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
insert into review values(null, "2024-04-19", "One of the most rewarding RPGs in years", 8, 1, 4);
insert into review values(null, "2024-04-19", "PC Game of the Year 2014", 9, 1, 5);
insert into review values(null, "2024-04-19", "As a fan of RPG's, Divinity: Original Sin really ticks (almost) all of the boxes of what constitutes a great game.", 9, 1, 3);
insert into review values(null, "2024-04-19", "The game is very interesting in term of gameplay but what more amazing is the engine itself. This game demonstrated how powerful the engine is, you pretty much have freedom in every corner from the quests, combat to interaction with NPCs.", 8, 1, 2);

-- TW Shogun 2
insert into review values(null, "2024-04-19", "Quite decent, but the Fall of the Samurai DLC is the best part of this game, due to the game's engine being made for musket warfare, not hand-to-hand combat.", 8, 2, 2);
insert into review values(null, "2024-04-19", "Shogun 2: Total War is hands down one of the best strategy games I've ever played. It's a great example of when a game is designed with pure, rewarding gameplay in mind.", 9, 2, 4);
insert into review values(null, "2024-04-19", "I bought with the intent of playing a campaign with a friend. After multiple hours put into the campaign, we would always come to a place where we had to quit because the files are corrupt.", 7, 2, 3);

-- DST
insert into review values(null, "2024-04-19", "It's a highly difficult survival game. It's hard enough just to survive hunger. We'd somehow managed to adapt to the harsh winter we'd been experiencing for the first time, and the shock we felt when a one-eyed monster destroyed our bustling base was incredible. My friend and I were silent for a while, feeling helpless.", 9, 3, 2);
insert into review values(null, "2024-04-19", "DST is a fun casual co=op, great for playing alone or with a group. Sometime it can be a little buggy but a quick reinstall will fix that.", 9, 3, 4);
insert into review values(null, "2024-04-19", "This game is cool. That's it. Stop reading and play already.", 10, 3, 3);

-- TW WH3
insert into review values(null, "2024-04-19", "The idea of playing Warhammer 3 total war is more appealing than actually playing it due to how much of it is (still) broken.", 6, 4, 3);
insert into review values(null, "2024-04-19", "This is the single most exploitative, anti consumer game I have ever played. You can see that there is 300 dollars or something like that of dlc but they don’t tell you about the various random hoops “free” dlc will have you jump through to get them, and ones that are marked as free in the battlemode roster page are often not.", 4, 4, 5);
insert into review values(null, "2024-04-19", "I go to sleep after this turn", 9, 4, 4);
insert into review values(null, "2024-04-19", "It's quite difficult finding an actual review on TW:Warhammer 3 as the Steam page is taken up by CA's exploitative DLC policies, their dumb forum comments and the White Knights trying to defend everything.", 8, 4, 6);

-- Oxygen Not Included
insert into review values(null, "2024-04-19", "The best colony sim I've ever played. The art and sound design are fantastic. The dupes are cute even when they're dying. Once you get over the learning cliff, the game is less of a crisis management simulator and more of a fun and mostly relaxing problem solver.", 9, 5, 2);
insert into review values(null, "2024-04-19", "A good game to sharpen your problem solving skills.", 9, 5, 4);
insert into review values(null, "2024-04-19", "I have been really enjoying this game, and trying to fix every mistake that I have made throughout it. I really like the design and physics of everything.", 8, 5, 5);

-- Dota
insert into review values(null, "2024-04-19", "I don't even know why I'm still playing", 9, 6, 5);
insert into review values(null, "2024-04-19", "the game has evolved so much that it has so much depth to it, and its a very good example of skill caps or brackets where its enjoyable at so many levels.", 8, 6, 3);
insert into review values(null, "2024-04-19", "I love the game, don't get me wrong, but save yourself the emotional pain. I'm already in too deep but there's still time for you to get out.", 7, 6, 4);
insert into review values(null, "2024-04-19", "You can find ur inner peace here :)", 9, 6, 2);
insert into review values(null, "2024-04-19", "Before you start this game think really hard at this. Do you enjoy toxicity every day in your life?", 6, 6, 6);

-- CS2
insert into review values(null, "2024-04-19", "this is the worst game I've ever played. It makes me want to pull my hair out, punch my computer, set it on fire, sell all of my belongings, move to Ibiza, and live the rest of my life with the mere memories of its horrors. anyways 10/10 would recommend :D", 10, 7, 2);
insert into review values(null, "2024-04-19", "So... In 9 out of 10 games you have a hacker either on the team, on the opposing team or on both teams. They can do whatever they want. Wallhack, spinning, rapidfire... It doesn't matter.", 6, 7, 3);
insert into review values(null, "2024-04-19", "It's fun. A lot of cheaters still and some of the most toxic players I have ever encountered but I have also met some awesome people who have become good friends.", 7, 7, 4);

-- Divinity OS 2
insert into review values(null, "2024-04-19", "I was expecting a 40-60 hour adventure like the first Original Sin. 120 hours later, the credits roll and what a ride it's been.", 9, 8, 2);
insert into review values(null, "2024-04-19", "I think I am near the end of the game now, and man it has been an amazing journey and I only wish there was more and the last act wasn't rushed.", 7, 8, 3);

-- TW Pharaoh
insert into review values(null, "2024-04-19", "Worst total war game out of the lot. small game very basic units all petty much look the same. The whole game looks and feels just MEH. first time iv ever had to give a total war game a negative review.", 2, 9, 2);
insert into review values(null, "2024-04-19", "Super irritated with this game. I bought this game just after release as I own most the total war games and love playing the multiplayer with my husband.", 3, 9, 5);

-- BG3
insert into review values(null, "2024-04-19", "A lot of words were said by other speakers, I will be brief: this is not the game of the year. This is the game of the decade", 10, 10, 4);
insert into review values(null, "2024-04-19", "I usually shun major AAA games in favor of small indie publishers. So when this game first came out and got a lot of attention, I ignored it, thinking it was overrated. Eventually, my curiosity got the best of me and I decided to give Baldur's Gate 3 a try. Boy, have I been missing out.", 9, 10, 5);
insert into review values(null, "2024-04-19", "What a game. I've done 7 playthroughs of this game, and learned something new each time, even when I thought I had learned it all.", 9, 10, 2);
insert into review values(null, "2024-04-19", "Cheaper than a crack addiction but somehow even more all-consuming than one!", 10, 10, 3);
insert into review values(null, "2024-04-19", "One of the best games I've ever played. Perfectly portrays D&D and in itself, with scenario, feeling, musics, graphics, characters. Its a captivating masterpiece. Proud to be a supporter on Early-Access.", 10, 10, 6);

-- TW Attila
insert into review values(null, "2024-04-19", "My favourite of the Total war series and the modding community is unbelievable as well adding so much replay value. Love it", 9, 11, 2);
insert into review values(null, "2024-04-19", "nice to play enjoy the dlc campains realy good but its only good with mods tbh with ofc haveing lots of bugs and problems", 7, 11, 5);
insert into review values(null, "2024-04-19", "Excellent game, high replay value, endless set ups, legendary achievements not available in other total war games (why, tho?), Mediterranean theatre. Good stuff creative assembly, stick to this.", 9, 11, 4);
insert into review values(null, "2024-04-19", "I just don't feel like playing Total War: Attila after beating Total War: Rome II. Why? Because it is basically the same game.", 5, 11, 6);

-- Rotwood
insert into review values(null, "2024-04-19", "Game is great, don't listen to some idiots that don't know what EARLY ACCESS means and saying that this game lacks content , like yeah?!", 8, 12, 2);
insert into review values(null, "2024-04-19", "At first, I wasn't sure about Rotwood. But, the more I played it, the more I got hooked on it. The art design is incredible, and the gameplay is fun and in-depth.", 9, 12, 3);
insert into review values(null, "2024-04-19", "I wish there was a 'Maybe' option for this. This game is good, but currently it is grindy.", 6, 12, 6);

-- Portal 2
insert into review values(null, "2024-04-19", "Portal 2 is one of the best puzzle games of all time. With creative puzzles, interesting plot, and graphics that still hold up to this game, I definitely recommend it.", 9, 13, 2);
insert into review values(null, "2024-04-19", "Hilarious game. I played with a friend on discord and I can't remember the last time I laughed so much going through a game.", 8, 13, 5);
insert into review values(null, "2024-04-19", "one of the greatest sequals and one of the best games ever. the only bad thing is replayability which it has many mods so you could just download mods and its fun again", 10, 13, 3);

-- TW 3K
insert into review values(null, "2024-04-19", "Simply put, the game has a lot of issues like bugs and even crashes that the developers apparently knew about and abandoned ship before they fixed them so you have to rely on community made mods to fix them, which are unstable at best.", 5, 14, 6);
insert into review values(null, "2024-04-19", "Kinda bs a Three Kingdoms game but has no three kingdoms scenario, kinda bs mod devs saved CA's ass again as well.", 2, 14, 4);
insert into review values(null, "2024-04-19", "with mods, as the game support has stopped but the mods make it a 20/10 game", 7, 14, 2);
insert into review values(null, "2024-04-19", "A great game, the building and hero management is more extensive than in any other Total War title, including Warhammer Total War.", 7, 14, 5);