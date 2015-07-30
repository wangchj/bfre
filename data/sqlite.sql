create table PropertyTypes (
    typeId integer primary key,
    typeName varchar(50) not null
);

insert into PropertyTypes(typeName) values('Commercial'),('Development'),('Farming'),('Hunting'),('Income'),('Industrial'),('Timber');

create table Properties (
    propId      integer         not null primary key,
    address     varchar(40)     null,
    city        varchar(20)     null,
    county      varchar(20)     not null,
    state       char(2)         not null,
    latlon      text            not null,   -- point not null,
    bound       text            null,       -- polygon null,
    headline    varchar(100)    not null,
    descr       text            not null,
    features    text            null,
    keywords    text            null,
    pictures    text            null,
    acres       float           not null,
    priceAcre   float           null,       -- price per acres
    priceTotal  float           null        -- total price
);

create table PropertyTypeMaps (
    propId      integer         not null,
    typeId      integer         not null,
    primary key (propId, typeId),
    foreign key (propId) references Properties(propId),
    foreign key (typeId) references PropertyTypes(typeId)
);

--
-- Unapproved users
--
create table TempUsers (
    userId   integer primary key,
    email    varchar(50) not null unique,
    phash    text not null, -- password hash with salt appended
    fname    varchar(30) not null,
    lname    varchar(30) not null,
    authKey  text not null  -- Yii Framework authentication key
);

create table Users (
    userId   integer primary key,
    email    varchar(50) not null unique,
    phash    text not null, -- password hash with salt appended
    fname    varchar(30) not null,
    lname    varchar(30) not null,
    authKey  text not null  -- Yii Framework authentication key
);
