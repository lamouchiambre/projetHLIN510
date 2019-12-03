
USE e20160018322;

DROP table if exists USER;
DROP table if exists EVENTS;
DROP table if exists LOCATIONS;
DROP table if exists THEME;
DROP table if exists REGISTER;
DROP table if exists RATE;

create table USER(
    us_id NUMERIC(10) NOT NULL,
    us_password NUMERIC(30) NOT NULL,
    us_role VARCHAR(30) CHECK (us_role IN ('administrator', 'contributor', 'visitor')),
    us_last_name VARCHAR(30), 
    us_first_name VARCHAR(30),
    us_email VARCHAR(30),
    CONSTRAINT pk_user PRIMARY KEY (us_id)
);
create table LOCATIONS(
    lo_id NUMERIC(10) NOT NULL,
    lo_name VARCHAR(30) NOT NULL, 
    lo_add VARCHAR(30) NOT NULL,
    lo_city VARCHAR(30) NOT NULL,
    lo_gps_coord VARCHAR(30) NOT NULL,
    CONSTRAINT pk_location PRIMARY KEY (lo_id)
);

create table THEME(
    th_id NUMERIC(10) NOT NULL,
    th_name VARCHAR(30) NOT NULL,
    CONSTRAINT pk_th PRIMARY KEY (th_id)
);

create table EVENTS(
    ev_id NUMERIC(10) NOT NULL,
    ev_price NUMERIC(10,2), 
    ev_date_start DATE NOT NULL, 
    ev_date_end DATE NOT NULL,
    ev_start_time TIME NOT NULL,
    ev_end_time TIME NOT NULL, 
    ev_nb_people_min NUMERIC(30), 
    ev_nb_people_max NUMERIC(30),
    ev_average NUMERIC(10),
    ev_lo_id NUMERIC(10) NOT NULL,
    ev_th_id NUMERIC(10) NOT NULL,
    CONSTRAINT pk_event PRIMARY KEY (ev_id),
    CONSTRAINT fk_event_lo FOREIGN KEY (ev_lo_id) REFERENCES LOCATIONS(lo_id),
    CONSTRAINT fk_event_th FOREIGN KEY (ev_th_id) REFERENCES THEME(th_id)
); 


create table REGISTER(
    re_registration_date DATE NOT NULL,
    re_us_id NUMERIC(10) NOT NULL,
    re_ev_id NUMERIC(10) NOT NULL,
    CONSTRAINT fk_re_us FOREIGN KEY (re_us_id) REFERENCES USER(us_id),
    CONSTRAINT fk_re_ev FOREIGN KEY (re_ev_id) REFERENCES EVENTS(ev_id),
    CONSTRAINT pk_re PRIMARY KEY (re_us_id, re_ev_id)
);
create table RATE(
    ra_date DATE NOT NULL,
    ra_rating NUMERIC(10) NOT NULL,
    ra_us_id NUMERIC(10) NOT NULL,
    ra_ev_id NUMERIC(10) NOT NULL,
    CONSTRAINT fk_ra_us FOREIGN KEY(ra_us_id) REFERENCES USER(us_id),
    CONSTRAINT fk_ra_ev FOREIGN KEY(ra_ev_id) REFERENCES EVENTS(ev_id),
    CONSTRAINT pk_ra PRIMARY KEY (ra_us_id, ra_ev_id)
);