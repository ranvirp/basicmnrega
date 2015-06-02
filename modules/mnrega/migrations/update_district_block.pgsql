update district set name_en=district_name,name_hi=district_name,code=district_code;
update block set name_en=block_name,name_hi=block_name,code=block_code;
alter table district drop constraint  district_pkey;
alter table district add constraint district_pkey primary key (code);
alter table block drop constraint  block_pkey;
alter table block add constraint  block_pkey primary key(code);
