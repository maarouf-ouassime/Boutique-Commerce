/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  20/06/2021 03:28:51                      */
/*==============================================================*/
drop table if exists APPARTIENT;

drop table if exists CATEGORY;

drop table if exists COMMAND;

drop table if exists CONTIENT;

drop table if exists PRODUCTS;

drop table if exists USERS;

/*==============================================================*/
/* Table : APPARTIENT                                           */
/*==============================================================*/
create table APPARTIENT
(
   ID                   char(250) not null,
   REF                  char(250) not null,
   primary key (ID, REF)
);

/*==============================================================*/
/* Table : CATEGORY                                             */
/*==============================================================*/
create table CATEGORY
(
   ID                   char(250) not null,
   NAME                 char(250),
   primary key (ID)
);

/*==============================================================*/
/* Table : COMMAND                                              */
/*==============================================================*/
create table COMMAND
(
   ID_CMD               char(250) not null,
   ID_USER              char(250) not null,
   TOTAL                char(250),
   QTE                  char(250),
   primary key (ID_CMD)
);

/*==============================================================*/
/* Table : CONTIENT                                             */
/*==============================================================*/
create table CONTIENT
(
   REF                  char(250) not null,
   ID_CMD               char(250) not null,
   primary key (REF, ID_CMD)
);

/*==============================================================*/
/* Table : PRODUCTS                                             */
/*==============================================================*/
create table PRODUCTS
(
   REF                  char(250) not null,
   NAME                 char(250),
   DESCRIPTION          char(250),
   PRICE                char(250),
   IMAGE                char(250),
   primary key (REF)
);

/*==============================================================*/
/* Table : USERS                                                */
/*==============================================================*/
create table USERS
(
   ID_USER              char(250) not null,
   EMAIL                char(250),
   PRENOM               char(250),
   NOM                  char(250),
   PASSWORD             char(250),
   primary key (ID_USER)
);

alter table APPARTIENT add constraint FK_APPARTIENT foreign key (REF)
      references PRODUCTS (REF) on delete restrict on update restrict;

alter table APPARTIENT add constraint FK_APPARTIENT2 foreign key (ID)
      references CATEGORY (ID) on delete restrict on update restrict;

alter table COMMAND add constraint FK_PASSER foreign key (ID_USER)
      references USERS (ID_USER) on delete restrict on update restrict;

alter table CONTIENT add constraint FK_CONTIENT foreign key (ID_CMD)
      references COMMAND (ID_CMD) on delete restrict on update restrict;

alter table CONTIENT add constraint FK_CONTIENT2 foreign key (REF)
      references PRODUCTS (REF) on delete restrict on update restrict;

