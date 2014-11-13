create table b_sale_auxiliary
(
	ID int not null auto_increment,
	TIMESTAMP_X timestamp not null,
	ITEM varchar(255) not null,
	ITEM_MD5 varchar(32) not null,
	USER_ID int not null,
	DATE_INSERT datetime not null,
	primary key (ID),
	unique IX_STT_USER_ITEM(USER_ID, ITEM_MD5)
);

create table b_sale_lang
(
	LID char(2) not null,
	CURRENCY char(3) not null,
	primary key (LID)
);

create table b_sale_fuser
(
	ID int not null auto_increment,
	DATE_INSERT datetime not null,
	DATE_UPDATE datetime not null,
	USER_ID INT NULL,
	primary key (ID),
	index IX_USER_ID(USER_ID)
);

create table b_sale_basket
(
	ID int not null auto_increment,
	FUSER_ID int not null,
	ORDER_ID int null,
	PRODUCT_ID int not null,
	PRODUCT_PRICE_ID int null,
	PRICE decimal(18, 2) not null,
	CURRENCY char(3) not null,
	DATE_INSERT datetime not null,
	DATE_UPDATE datetime not null,
	WEIGHT double(18, 2) null,
	QUANTITY double(18, 2) not null default '0',
	LID char(2) not null,
	DELAY char(1) not null default 'N',
	NAME varchar(255) not null,
	CAN_BUY char(1) not null default 'Y',
	MODULE varchar(100) null,
	CALLBACK_FUNC varchar(100) null,
	NOTES varchar(250) null,
	ORDER_CALLBACK_FUNC varchar(100) null,
	DETAIL_PAGE_URL varchar(250) null,
	DISCOUNT_PRICE decimal(18,2) not null default '0',
	CANCEL_CALLBACK_FUNC varchar(100) null,
	PAY_CALLBACK_FUNC varchar(100) null,
	CATALOG_XML_ID varchar(100) null,
	PRODUCT_XML_ID varchar(100) null,
	DISCOUNT_NAME varchar(255) null,
	DISCOUNT_VALUE char(32) null,
	DISCOUNT_COUPON char(32) null,
	VAT_RATE DECIMAL(18, 2) NULL default '0.00',
	primary key (ID),
	index IXS_BASKET_LID(LID),
	index IXS_BASKET_USER_ID(FUSER_ID),
	index IXS_BASKET_ORDER_ID(ORDER_ID),
	index IXS_BASKET_PRODUCT_ID(PRODUCT_ID),
	index IXS_BASKET_PRODUCT_PRICE_ID(PRODUCT_PRICE_ID),
	index IXS_SBAS_XML_ID(PRODUCT_XML_ID, CATALOG_XML_ID)
);

create table b_sale_basket_props
(
	ID int not null auto_increment,
	BASKET_ID int not null,
	NAME varchar(255) not null,
	VALUE varchar(255) null,
	CODE varchar(255) null,
	SORT int not null default '100',
	primary key (ID),
	index IXS_BASKET_PROPS_BASKET(BASKET_ID),
	index IXS_BASKET_PROPS_CODE(CODE)
);

create table b_sale_order
(
	ID int not null auto_increment,
	LID char(2) not null,
	PERSON_TYPE_ID int not null,
	PAYED char(1) not null default 'N',
	DATE_PAYED datetime null,
	EMP_PAYED_ID int null,
	CANCELED char(1) not null default 'N',
	DATE_CANCELED datetime null,
	EMP_CANCELED_ID int null,
	REASON_CANCELED varchar(255) null,
	STATUS_ID char(1) not null default 'N',
	DATE_STATUS datetime not null,
	EMP_STATUS_ID int null,
	PRICE_DELIVERY decimal(18,2) not null,
	ALLOW_DELIVERY char(1) not null default 'N',
	DATE_ALLOW_DELIVERY datetime null,
	EMP_ALLOW_DELIVERY_ID int null,
	PRICE decimal(18, 2) not null,
	CURRENCY char(3) not null,
	DISCOUNT_VALUE decimal(18,2) not null,
	USER_ID int not null,
	PAY_SYSTEM_ID int null,
	DELIVERY_ID varchar(50) null,
	DATE_INSERT datetime not null,
	DATE_UPDATE datetime not null,
	USER_DESCRIPTION varchar(250) null,
	ADDITIONAL_INFO varchar(255) null,
	PS_STATUS char(1) null,
	PS_STATUS_CODE char(5) null,
	PS_STATUS_DESCRIPTION varchar(250) null,
	PS_STATUS_MESSAGE varchar(250) null,
	PS_SUM decimal(18,2) null,
	PS_CURRENCY char(3) null,
	PS_RESPONSE_DATE datetime null,
	COMMENTS text null,
	TAX_VALUE decimal(18,2) not null default '0.00',
	STAT_GID varchar(255) null,
	SUM_PAID decimal(18,2) not null default '0',
	RECURRING_ID int null,
	PAY_VOUCHER_NUM varchar(20) null,
	PAY_VOUCHER_DATE date null,
	LOCKED_BY int null,
	DATE_LOCK datetime null,
	RECOUNT_FLAG char(1) not null default 'Y',
	AFFILIATE_ID int null,
	primary key (ID),
	index IXS_ORDER_USER_ID(USER_ID),
	index IXS_ORDER_PERSON_TYPE_ID(PERSON_TYPE_ID),
	index IXS_ORDER_PAYED(PAYED),
	index IXS_ORDER_STATUS_ID(STATUS_ID),
	index IXS_ORDER_REC_ID(RECURRING_ID),
	index IX_SOO_AFFILIATE_ID(AFFILIATE_ID)
);

create table b_sale_person_type
(
	ID int not null auto_increment,
	LID char(2) not null,
	NAME varchar(255) not null,
	SORT int not null default '150',
	primary key (ID),
	index IXS_PERSON_TYPE_LID(LID)
);

create table b_sale_order_props_group
(
	ID int not null auto_increment,
	PERSON_TYPE_ID int not null,
	NAME varchar(255) not null,
	SORT int not null default '100',
	primary key (ID),
	index IXS_ORDER_PROPS_GROUP_PERSON_TYPE_ID(PERSON_TYPE_ID)
);

create table b_sale_order_props
(
	ID int not null auto_increment,
	PERSON_TYPE_ID int not null,
	NAME varchar(255) not null,
	TYPE varchar(20) not null,
	REQUIED char(1) not null default 'N',
	DEFAULT_VALUE varchar(255) null,
	SORT int not null default '100',
	USER_PROPS char(1) not null default 'N',
	IS_LOCATION char(1) not null default 'N',
	PROPS_GROUP_ID int not null,
	SIZE1 int not null default '0',
	SIZE2 int not null default '0',
	DESCRIPTION varchar(255) null,
	IS_EMAIL char(1) not null default 'N',
	IS_PROFILE_NAME char(1) not null default 'N',
	IS_PAYER char(1) not null default 'N',
	IS_LOCATION4TAX char(1) not null default 'N',
	IS_FILTERED char(1) not null default 'N',
	CODE varchar(50) null,
	primary key (ID),
	index IXS_ORDER_PROPS_PERSON_TYPE_ID(PERSON_TYPE_ID),
	index IXS_CODE_OPP(CODE)
);

create table b_sale_order_props_value
(
	ID int not null auto_increment,
	ORDER_ID int not null,
	ORDER_PROPS_ID int null,
	NAME varchar(255) not null,
	VALUE varchar(255) null,
	CODE varchar(50) null,
	primary key (ID),
	unique IX_SOPV_ORD_PROP_UNI(ORDER_ID, ORDER_PROPS_ID)
);

create table b_sale_order_props_variant
(
	ID int not null auto_increment,
	ORDER_PROPS_ID int not null,
	NAME varchar(255) not null,
	VALUE varchar(255) null,
	SORT int not null default '100',
	DESCRIPTION varchar(255) null,
	primary key (ID),
	index IXS_ORDER_PROPS_VARIANT_ORDER_PROPS_ID(ORDER_PROPS_ID)
);

create table b_sale_pay_system
(
	ID int not null auto_increment,
	LID char(2) not null,
	CURRENCY char(3) not null,
	NAME varchar(255) not null,
	ACTIVE char(1) not null default 'Y',
	SORT int not null default '100',
	DESCRIPTION varchar(250) null,
	primary key (ID),
	index IXS_PAY_SYSTEM_LID(LID)
);

create table b_sale_pay_system_action
(
	ID int not null auto_increment,
	PAY_SYSTEM_ID int not null,
	PERSON_TYPE_ID int not null,
	NAME varchar(255) not null,
	ACTION_FILE varchar(255) null,
	RESULT_FILE varchar(255) null,
	NEW_WINDOW char(1) not null default 'Y',
	PARAMS text null,
	HAVE_PAYMENT char(1) not null default 'N',
	HAVE_ACTION char(1) not null default 'N',
	HAVE_RESULT char(1) not null default 'N',
	HAVE_PREPAY char(1) not null default 'N',
	HAVE_RESULT_RECEIVE char(1) not null default 'N',
	ENCODING varchar(45) null,
	primary key (ID),
	unique IX_SPSA_PSPT_UNI(PAY_SYSTEM_ID, PERSON_TYPE_ID),
	index IXS_PAY_SYSTEM_ACTION_PERSON_TYPE_ID(PERSON_TYPE_ID)
);

create table b_sale_delivery
(
	ID int not null auto_increment,
	NAME varchar(255) not null,
	LID char(2) not null,
	PERIOD_FROM int null,
	PERIOD_TO int null,
	PERIOD_TYPE char(1) null,
	WEIGHT_FROM int null,
	WEIGHT_TO int null,
	ORDER_PRICE_FROM decimal(18, 2) null,
	ORDER_PRICE_TO decimal(18, 2) null,
	ORDER_CURRENCY char(3) null,
	ACTIVE char(1) not null default 'Y',
	PRICE decimal(18, 2) not null,
	CURRENCY char(3) not null,
	SORT int not null default '100',
	DESCRIPTION varchar(250) null,
	primary key (ID),
	index IXS_DELIVERY_LID(LID)
);

create table b_sale_location_country
(
	ID int not null auto_increment,
	NAME varchar(100) not null,
	SHORT_NAME varchar(100) null,
	primary key (ID)
);

create table b_sale_location_country_lang
(
	ID int not null auto_increment,
	COUNTRY_ID int not null,
	LID char(2) not null,
	NAME varchar(100) not null,
	SHORT_NAME varchar(100) null,
	primary key (ID),
	unique IXS_LOCAT_CNTR_LID(COUNTRY_ID, LID)
);

create table b_sale_location_city
(
	ID int not null auto_increment,
	NAME varchar(100) not null,
	SHORT_NAME varchar(100) null,
	primary key (ID)
);

create table b_sale_location_city_lang
(
	ID int not null auto_increment,
	CITY_ID int not null,
	LID char(2) not null,
	NAME varchar(100) not null,
	SHORT_NAME varchar(100) null,
	primary key (ID),
	unique IXS_LOCAT_CITY_LID(CITY_ID, LID)
);

create table b_sale_location
(
	ID int not null auto_increment,
	COUNTRY_ID int not null,
	CITY_ID int null,
	SORT int not null default '100',
	primary key (ID),
	index IXS_LOCATION_COUNTRY_ID(COUNTRY_ID),
	index IXS_LOCATION_CITY_ID(CITY_ID)
);

create table b_sale_location_group
(
	ID int not null auto_increment,
	SORT int not null default '100',
	primary key (ID)
);

create table b_sale_location_group_lang
(
	ID int not null auto_increment,
	LOCATION_GROUP_ID int not null,
	LID char(2) not null,
	NAME varchar(250) not null,
	primary key (ID),
	unique ix_location_group_lid(LOCATION_GROUP_ID, LID)
);

create table b_sale_location2location_group
(
	LOCATION_ID int not null,
	LOCATION_GROUP_ID int not null,
	primary key (LOCATION_ID, LOCATION_GROUP_ID)
);

create table b_sale_delivery2location
(
	DELIVERY_ID int not null,
	LOCATION_ID int not null,
	LOCATION_TYPE char(1) not null default 'L',
	primary key (DELIVERY_ID, LOCATION_ID, LOCATION_TYPE)
);

create table b_sale_discount
(
	ID int not null auto_increment,
	LID char(2) not null,
	PRICE_FROM decimal(18, 2) null,
	PRICE_TO decimal(18, 2) null,
	CURRENCY char(3) null,
	DISCOUNT_VALUE decimal(18, 2) not null,
	DISCOUNT_TYPE char(1) not null default 'P',
	ACTIVE char(1) not null default 'Y',
	SORT int not null default '100',
	ACTIVE_FROM datetime null,
	ACTIVE_TO datetime null,
	primary key (ID),
	index IXS_DISCOUNT_LID(LID),
	index IX_SSD_ACTIVE_DATE(ACTIVE_FROM, ACTIVE_TO)
);


create table b_sale_user_props
(
	ID int not null auto_increment,
	NAME varchar(255) not null,
	USER_ID int not null,
	PERSON_TYPE_ID int not null,
	DATE_UPDATE datetime not null,
	primary key (ID),
	index IXS_USER_PROPS_USER_ID(USER_ID),
	index IXS_USER_PROPS_PERSON_TYPE_ID(PERSON_TYPE_ID)
);

create table b_sale_user_props_value
(
	ID int not null auto_increment,
	USER_PROPS_ID int not null,
	ORDER_PROPS_ID int not null,
	NAME varchar(255) not null,
	VALUE varchar(255) null,
	primary key (ID),
	index IXS_USER_PROPS_VALUE_USER_PROPS_ID(USER_PROPS_ID),
	index IXS_USER_PROPS_VALUE_ORDER_PROPS_ID(ORDER_PROPS_ID)
);

create table b_sale_status
(
	ID char(1) not null,
	SORT int not null default '100',
	primary key (ID)
);

create table b_sale_status_lang
(
	STATUS_ID char(1) not null,
	LID char(2) not null,
	NAME varchar(100) not null,
	DESCRIPTION varchar(250) null,
	primary key (STATUS_ID, LID),
	unique ixs_status_lang_status_id(STATUS_ID, LID)
);

create table b_sale_tax
(
	ID int not null auto_increment,
	LID char(2) not null,
	NAME varchar(250) not null,
	DESCRIPTION varchar(255) null,
	TIMESTAMP_X datetime not null,
	CODE varchar(50) null,
	primary key (ID),
	index itax_lid(LID)
);

create table b_sale_tax_rate
(
	ID int not null auto_increment,
	TAX_ID int not null,
	PERSON_TYPE_ID int null,
	VALUE decimal(18,4) not null,
	CURRENCY char(3) null,
	IS_PERCENT char(1) not null default 'Y',
	IS_IN_PRICE char(1) not null default 'N',
	APPLY_ORDER int not null default '100',
	TIMESTAMP_X datetime not null,
	ACTIVE char(1) not null default 'Y',
	primary key (ID),
	index itax_pers_type(PERSON_TYPE_ID),
	index itax_lid(TAX_ID),
	index itax_inprice(IS_IN_PRICE)
);

create table b_sale_tax2location
(
	TAX_RATE_ID int not null,
	LOCATION_ID int not null,
	LOCATION_TYPE char(1) not null default 'L',
	primary key (TAX_RATE_ID, LOCATION_ID, LOCATION_TYPE)
);

create table b_sale_tax_exempt2group
(
	GROUP_ID int not null,
	TAX_ID int not null,
	primary key (GROUP_ID, TAX_ID)
);

create table b_sale_order_tax
(
	ID int not null auto_increment,
	ORDER_ID int not null,
	TAX_NAME varchar(255) not null,
	VALUE decimal(18,2) null,
	VALUE_MONEY decimal(18,2) not null,
	APPLY_ORDER int not null,
	CODE varchar(50) null,
	IS_PERCENT char(1) not null default 'Y',
	IS_IN_PRICE char(1) not null default 'N',
	primary key (ID),
	index ixs_sot_order_id(ORDER_ID)
);

create table b_sale_status2group
(
  ID int not null auto_increment,
  GROUP_ID int not null,
  STATUS_ID char(1) not null,
  PERM_VIEW char(1) not null default 'N',
  PERM_CANCEL char(1) not null default 'N',
  PERM_DELIVERY char(1) not null default 'N',
  PERM_PAYMENT char(1) not null default 'N',
  PERM_STATUS char(1) not null default 'N',
  PERM_UPDATE char(1) not null default 'N',
  PERM_DELETE char(1) not null default 'N',
  PERM_STATUS_FROM char(1) not null default 'N',
  primary key (ID)
);

alter table b_sale_status2group add unique ix_sale_s2g_ix1(GROUP_ID, STATUS_ID);

create table b_sale_order_flags2group
(
  ID int not null auto_increment,
  GROUP_ID int not null,
  ORDER_FLAG char(1) not null,
  primary key (ID),
  unique ix_sale_ordfla2group(GROUP_ID, ORDER_FLAG)
);

create table b_sale_site2group
(
  ID int not null auto_increment,
  GROUP_ID int not null,
  SITE_ID char(2) not null,
  primary key (ID),
  unique ix_sale_site2group(GROUP_ID, SITE_ID)
);

create table b_sale_user_account
(
  ID int not null auto_increment,
  USER_ID int not null,
  TIMESTAMP_X timestamp not null,
  CURRENT_BUDGET decimal(18,4) not null default '0.0',
  CURRENCY char(3) not null,
  LOCKED char(1) not null default 'N',
  DATE_LOCKED datetime null,
  NOTES text null,
  primary key (ID),
  unique IX_S_U_USER_ID(USER_ID, CURRENCY)
);

create table b_sale_recurring
(
  ID int not null auto_increment,
  USER_ID int not null,
  TIMESTAMP_X timestamp not null,
  MODULE varchar(100) null,
  PRODUCT_ID int null,
  PRODUCT_NAME varchar(255) null,
  PRODUCT_URL varchar(255) null,
  PRODUCT_PRICE_ID int null,
  PRICE_TYPE char(1) not null default 'R',
  RECUR_SCHEME_TYPE char(1) not null default 'M',
  RECUR_SCHEME_LENGTH int not null default '0',
  WITHOUT_ORDER char(1) not null default 'N',
  PRICE decimal not null default '0.0',
  CURRENCY char(3) null,
  CANCELED char(1) not null default 'N',
  DATE_CANCELED datetime null,
  PRIOR_DATE datetime null,
  NEXT_DATE datetime not null,
  CALLBACK_FUNC varchar(100) null,
  DESCRIPTION varchar(255) null,
  CANCELED_REASON varchar(255) null,
  ORDER_ID int not null,
  REMAINING_ATTEMPTS int not null default '0',
  SUCCESS_PAYMENT char(1) not null default 'Y',
  primary key (ID),
  index IX_S_R_USER_ID(USER_ID),
  index IX_S_R_NEXT_DATE(NEXT_DATE, CANCELED, REMAINING_ATTEMPTS),
  index IX_S_R_PRODUCT_ID(MODULE, PRODUCT_ID, PRODUCT_PRICE_ID)
);

create table b_sale_user_cards
(
  ID int not null auto_increment,
  USER_ID int not null,
  ACTIVE char(1) not null default 'Y',
  SORT int not null default '100',
  TIMESTAMP_X timestamp not null,
  PAY_SYSTEM_ACTION_ID int not null,
  CURRENCY char(3) null,
  CARD_TYPE varchar(20) not null,
  CARD_NUM text not null,
  CARD_CODE varchar(5) null,
  CARD_EXP_MONTH int not null,
  CARD_EXP_YEAR int not null,
  DESCRIPTION varchar(255) null,
  SUM_MIN decimal(18,4) null,
  SUM_MAX decimal(18,4) null,
  SUM_CURRENCY char(3) null,
  LAST_STATUS char(1) null,
  LAST_STATUS_CODE varchar(5) null,
  LAST_STATUS_DESCRIPTION varchar(250) null,
  LAST_STATUS_MESSAGE varchar(255) null,
  LAST_SUM decimal(18,4) null,
  LAST_CURRENCY char(3) null,
  LAST_DATE datetime null,
  primary key (ID),
  index IX_S_U_C_USER_ID(USER_ID, ACTIVE, CURRENCY)
);


create table b_sale_user_transact
(
  ID int not null auto_increment,
  USER_ID int not null,
  TIMESTAMP_X timestamp not null,
  TRANSACT_DATE datetime not null,
  AMOUNT decimal(18,4) not null default '0.0',
  CURRENCY char(3) not null,
  DEBIT char(1) not null default 'N',
  ORDER_ID int null,
  DESCRIPTION varchar(255) not null,
  NOTES text null,
  EMPLOYEE_ID int(11) null,
  primary key (ID),
  index IX_S_U_T_USER_ID(USER_ID),
  index IX_S_U_T_TRANSACT_DATE(TRANSACT_DATE),
  index IX_S_U_T_CURRENCY(CURRENCY)
);

create table b_sale_affiliate_plan
(
  ID int not null auto_increment
,  SITE_ID char(2) not null
,  NAME varchar(250) not null
,  DESCRIPTION text null
,  TIMESTAMP_X timestamp not null
,  ACTIVE char(1) not null default 'Y'
,  BASE_RATE decimal(18,4) not null default '0'
,  BASE_RATE_TYPE char(1) not null default 'P'
,  BASE_RATE_CURRENCY char(3) null
,  MIN_PAY decimal(18,4) not null default '0'
,  MIN_PLAN_VALUE decimal(18,4) null
,  VALUE_CURRENCY char(3) null
,  primary key (ID)
);

create table b_sale_affiliate
(
  ID int not null auto_increment
,  SITE_ID char(2) not null
,  USER_ID int not null
,  AFFILIATE_ID int null
,  PLAN_ID int not null
,  ACTIVE char(1) not null default 'Y'
,  TIMESTAMP_X timestamp not null
,  DATE_CREATE datetime not null
,  PAID_SUM decimal(18,4) not null default '0'
,  APPROVED_SUM decimal(18,4) not null default '0'
,  PENDING_SUM decimal(18,4) not null default '0'
,  ITEMS_NUMBER int not null default '0'
,  ITEMS_SUM decimal(18,4) not null default '0'
,  LAST_CALCULATE datetime null
,  AFF_SITE varchar(200) null
,  AFF_DESCRIPTION text null
,  FIX_PLAN char(1) not null default 'N'
,  primary key (ID)
,  unique IX_SAA_USER_ID(USER_ID, SITE_ID)
,  index IX_SAA_AFFILIATE_ID(AFFILIATE_ID)
);

create table b_sale_affiliate_plan_section
(
  ID int not null auto_increment
,  PLAN_ID int not null
,  MODULE_ID varchar(50) not null default 'catalog'
,  SECTION_ID varchar(255) not null
,  RATE decimal(18,4) not null default '0'
,  RATE_TYPE char(1) not null default 'P'
,  RATE_CURRENCY char(3) null
,  primary key (ID)
,  unique IX_SAP_PLAN_ID(PLAN_ID, MODULE_ID, SECTION_ID)
);

create table b_sale_affiliate_tier
(
  ID int not null auto_increment
,  SITE_ID char(2) not null
,  RATE1 decimal(18,4) not null default '0'
,  RATE2 decimal(18,4) not null default '0'
,  RATE3 decimal(18,4) not null default '0'
,  RATE4 decimal(18,4) not null default '0'
,  RATE5 decimal(18,4) not null default '0'
,  primary key (ID)
,  unique IX_SAT_SITE_ID(SITE_ID)
);

create table b_sale_affiliate_transact
(
  ID int not null auto_increment
,  AFFILIATE_ID int not null
,  TIMESTAMP_X timestamp not null
,  TRANSACT_DATE datetime not null
,  AMOUNT decimal(18,4) not null
,  CURRENCY char(3) not null
,  DEBIT char(1) not null default 'N'
,  DESCRIPTION varchar(100) not null
,  EMPLOYEE_ID int null
,  primary key (ID)
,  index IX_SAT_AFFILIATE_ID(AFFILIATE_ID)
);

create table b_sale_export
(
  ID int not null auto_increment
,  PERSON_TYPE_ID int not null
,  VARS text null
,  primary key (ID)
);

CREATE TABLE b_sale_delivery_handler (
  ID int(11) NOT NULL auto_increment,
  LID char(2) default '',
  ACTIVE char(1) default 'Y',
  HID varchar(50) NOT NULL default '',
  NAME varchar(255) NOT NULL default '',
  SORT int(11) NOT NULL default '100',
  DESCRIPTION text,
  HANDLER varchar(255) NOT NULL default '',
  SETTINGS text,
  PROFILES text,
  TAX_RATE double NULL default '0',
  PRIMARY KEY  (ID),
  index IX_HID (HID)
);

CREATE TABLE b_sale_location_zip (
  ID int(11) NOT NULL auto_increment,
  LOCATION_ID int(11) NOT NULL default '0',
  ZIP varchar(10) NOT NULL default '',
  PRIMARY KEY  (ID),
  index IX_LOCATION_ID (LOCATION_ID),
  index IX_ZIP (ZIP)
);
