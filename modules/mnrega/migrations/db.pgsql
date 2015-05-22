--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: agency; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE agency (
    id integer NOT NULL,
    name_hi character varying(255),
    name_en character varying(255)
);


ALTER TABLE public.agency OWNER TO mac;

--
-- Name: agency_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE agency_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.agency_id_seq OWNER TO mac;

--
-- Name: agency_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE agency_id_seq OWNED BY agency.id;


--
-- Name: authassignment; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE authassignment (
    item_name character varying(64) NOT NULL,
    user_id character varying(64) NOT NULL,
    created_at integer
);


ALTER TABLE public.authassignment OWNER TO mac;

--
-- Name: authitem; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE authitem (
    name character varying(64) NOT NULL,
    type integer NOT NULL,
    description text,
    rule_name character varying(64),
    data text,
    created_at integer,
    updated_at integer
);


ALTER TABLE public.authitem OWNER TO mac;

--
-- Name: authitemchild; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE authitemchild (
    parent character varying(64) NOT NULL,
    child character varying(64) NOT NULL
);


ALTER TABLE public.authitemchild OWNER TO mac;

--
-- Name: authrule; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE authrule (
    name character varying(64) NOT NULL,
    data text,
    created_at integer,
    updated_at integer
);


ALTER TABLE public.authrule OWNER TO mac;

--
-- Name: block; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE block (
    block_code character varying(7) NOT NULL,
    block_name character varying(100),
    district_code character varying(4)
);


ALTER TABLE public.block OWNER TO mac;

--
-- Name: department; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE department (
    id integer NOT NULL,
    name_hi character varying(255) NOT NULL,
    name_en character varying(255) NOT NULL,
    created_at integer NOT NULL,
    updated_at integer NOT NULL
);


ALTER TABLE public.department OWNER TO mac;

--
-- Name: department_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE department_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.department_id_seq OWNER TO mac;

--
-- Name: department_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE department_id_seq OWNED BY department.id;


--
-- Name: designation; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE designation (
    id integer NOT NULL,
    designation_type_id integer NOT NULL,
    level_id integer NOT NULL,
    officer_name_hi character varying(100),
    officer_name_en character varying(32),
    officer_mobile character varying(12),
    officer_mobile1 character varying(12),
    officer_email character varying(32),
    officer_userid integer NOT NULL,
    name_hi character varying(255) NOT NULL,
    name_en character varying(255) NOT NULL,
    created_at integer NOT NULL,
    updated_at integer NOT NULL
);


ALTER TABLE public.designation OWNER TO mac;

--
-- Name: designation_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE designation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.designation_id_seq OWNER TO mac;

--
-- Name: designation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE designation_id_seq OWNED BY designation.id;


--
-- Name: designation_type; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE designation_type (
    id integer NOT NULL,
    level_id integer NOT NULL,
    name_hi character varying(255) NOT NULL,
    name_en character varying(255) NOT NULL,
    shortcode character varying(10) NOT NULL,
    created_at integer NOT NULL,
    updated_at integer NOT NULL
);


ALTER TABLE public.designation_type OWNER TO mac;

--
-- Name: designation_type_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE designation_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.designation_type_id_seq OWNER TO mac;

--
-- Name: designation_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE designation_type_id_seq OWNED BY designation_type.id;


--
-- Name: district; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE district (
    district_code character varying(4) NOT NULL,
    district_name character varying(100)
);


ALTER TABLE public.district OWNER TO mac;

--
-- Name: level; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE level (
    id integer NOT NULL,
    dept_id integer NOT NULL,
    name_hi character varying(255) NOT NULL,
    name_en character varying(255) NOT NULL,
    class_name character varying(50) NOT NULL,
    created_at integer NOT NULL,
    updated_at integer NOT NULL
);


ALTER TABLE public.level OWNER TO mac;

--
-- Name: level_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE level_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.level_id_seq OWNER TO mac;

--
-- Name: level_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE level_id_seq OWNED BY level.id;


--
-- Name: marking; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE marking (
    id integer NOT NULL,
    request_id integer,
    sender integer,
    receiver integer,
    dateofmarking date,
    deadline date,
    create_time integer,
    update_time integer,
    read_time integer
);


ALTER TABLE public.marking OWNER TO mac;

--
-- Name: marking_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE marking_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.marking_id_seq OWNER TO mac;

--
-- Name: marking_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE marking_id_seq OWNED BY marking.id;


--
-- Name: migration; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE migration (
    version character varying(180) NOT NULL,
    apply_time integer
);


ALTER TABLE public.migration OWNER TO mac;

--
-- Name: panchayat; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE panchayat (
    district_code character varying(255),
    block_code character varying(255),
    code character varying(5) NOT NULL,
    name_hi character varying(255),
    name_en character varying(255),
    census_code character varying(7)
);


ALTER TABLE public.panchayat OWNER TO mac;

--
-- Name: parameter; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE parameter (
    id integer NOT NULL,
    type integer DEFAULT 0,
    link character varying(255),
    parser text,
    name_hi character varying(255),
    name_en character varying(255),
    shortcode character varying(255),
    description character varying(255),
    weight integer,
    unit character varying(255)
);


ALTER TABLE public.parameter OWNER TO mac;

--
-- Name: parameter_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE parameter_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.parameter_id_seq OWNER TO mac;

--
-- Name: parameter_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE parameter_id_seq OWNED BY parameter.id;


--
-- Name: parameter_parse; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE parameter_parse (
    id integer NOT NULL,
    parameter_id integer,
    json_value text,
    update_time integer,
    dld_data text,
    level integer DEFAULT 0,
    district_code character varying(4) DEFAULT '0'::character varying
);


ALTER TABLE public.parameter_parse OWNER TO mac;

--
-- Name: parameter_parse_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE parameter_parse_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.parameter_parse_id_seq OWNER TO mac;

--
-- Name: parameter_parse_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE parameter_parse_id_seq OWNED BY parameter_parse.id;


--
-- Name: parameter_target; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE parameter_target (
    id integer NOT NULL,
    parameter_id integer,
    district_id character varying(255),
    parameter_target character varying(255),
    month integer
);


ALTER TABLE public.parameter_target OWNER TO mac;

--
-- Name: parameter_target_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE parameter_target_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.parameter_target_id_seq OWNER TO mac;

--
-- Name: parameter_target_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE parameter_target_id_seq OWNED BY parameter_target.id;


--
-- Name: parameter_value; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE parameter_value (
    id integer NOT NULL,
    parameter_id integer,
    district_id character varying(255),
    parameter_value character varying(255),
    update_time integer
);


ALTER TABLE public.parameter_value OWNER TO mac;

--
-- Name: parameter_value_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE parameter_value_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.parameter_value_id_seq OWNER TO mac;

--
-- Name: parameter_value_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE parameter_value_id_seq OWNED BY parameter_value.id;


--
-- Name: request; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE request (
    id integer NOT NULL,
    request_type_id integer,
    request_subject character varying(255) NOT NULL,
    content text,
    attachments text,
    author_id integer,
    create_time integer,
    update_time integer
);


ALTER TABLE public.request OWNER TO mac;

--
-- Name: request_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE request_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.request_id_seq OWNER TO mac;

--
-- Name: request_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE request_id_seq OWNED BY request.id;


--
-- Name: request_type; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE request_type (
    id integer NOT NULL,
    category integer,
    name character varying(255)
);


ALTER TABLE public.request_type OWNER TO mac;

--
-- Name: request_type_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE request_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.request_type_id_seq OWNER TO mac;

--
-- Name: request_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE request_type_id_seq OWNED BY request_type.id;


--
-- Name: scheme; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE scheme (
    id integer NOT NULL,
    code character varying(10),
    name_hi character varying(255),
    name_en character varying(255),
    description character varying(255),
    finyear character varying(255),
    documents character varying(255),
    noofworks integer,
    totalcost double precision
);


ALTER TABLE public.scheme OWNER TO mac;

--
-- Name: scheme_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE scheme_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.scheme_id_seq OWNER TO mac;

--
-- Name: scheme_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE scheme_id_seq OWNED BY scheme.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE "user" (
    id integer NOT NULL,
    username character varying(255) NOT NULL,
    auth_key character varying(32),
    password_hash character varying(255) NOT NULL,
    password_reset_token character varying(255),
    email character varying(255),
    status smallint DEFAULT 10 NOT NULL,
    created_at integer NOT NULL,
    updated_at integer NOT NULL
);


ALTER TABLE public."user" OWNER TO mac;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO mac;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE user_id_seq OWNED BY "user".id;


--
-- Name: village; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE village (
    district_code character varying(255),
    block_code character varying(255),
    code character varying(5) NOT NULL,
    name_hi character varying(255),
    name_en character varying(255),
    census_code character varying(7)
);


ALTER TABLE public.village OWNER TO mac;

--
-- Name: websitemanagement; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE websitemanagement (
    id integer NOT NULL,
    name_hi character varying(255) NOT NULL,
    name_en character varying(255) NOT NULL
);


ALTER TABLE public.websitemanagement OWNER TO mac;

--
-- Name: websitemanagement_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE websitemanagement_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.websitemanagement_id_seq OWNER TO mac;

--
-- Name: websitemanagement_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE websitemanagement_id_seq OWNED BY websitemanagement.id;


--
-- Name: work; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE work (
    id integer NOT NULL,
    workid character varying(255) NOT NULL,
    name_hi character varying(255),
    name_en character varying(255),
    description text,
    agency_id integer,
    work_type_id integer,
    totvalue double precision,
    scheme_id integer,
    district_id integer,
    address character varying(255),
    gpslat double precision,
    gpslong double precision,
    work_admin integer,
    block_code character varying(255),
    panchayat_code character varying(255) DEFAULT NULL::character varying,
    village_code character varying(255),
    status smallint DEFAULT 0 NOT NULL,
    remarks text,
    created_at integer NOT NULL,
    updated_at integer NOT NULL
);


ALTER TABLE public.work OWNER TO mac;

--
-- Name: work_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE work_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.work_id_seq OWNER TO mac;

--
-- Name: work_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE work_id_seq OWNED BY work.id;


--
-- Name: work_progress; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE work_progress (
    id integer NOT NULL,
    work_id integer,
    exp double precision,
    phy integer,
    fin integer
);


ALTER TABLE public.work_progress OWNER TO mac;

--
-- Name: work_progress_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE work_progress_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.work_progress_id_seq OWNER TO mac;

--
-- Name: work_progress_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE work_progress_id_seq OWNED BY work_progress.id;


--
-- Name: work_type; Type: TABLE; Schema: public; Owner: mac; Tablespace: 
--

CREATE TABLE work_type (
    id integer NOT NULL,
    code character varying(5),
    name_hi character varying(255),
    name_en character varying(255)
);


ALTER TABLE public.work_type OWNER TO mac;

--
-- Name: work_type_id_seq; Type: SEQUENCE; Schema: public; Owner: mac
--

CREATE SEQUENCE work_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.work_type_id_seq OWNER TO mac;

--
-- Name: work_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: mac
--

ALTER SEQUENCE work_type_id_seq OWNED BY work_type.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY agency ALTER COLUMN id SET DEFAULT nextval('agency_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY department ALTER COLUMN id SET DEFAULT nextval('department_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY designation ALTER COLUMN id SET DEFAULT nextval('designation_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY designation_type ALTER COLUMN id SET DEFAULT nextval('designation_type_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY level ALTER COLUMN id SET DEFAULT nextval('level_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY marking ALTER COLUMN id SET DEFAULT nextval('marking_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY parameter ALTER COLUMN id SET DEFAULT nextval('parameter_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY parameter_parse ALTER COLUMN id SET DEFAULT nextval('parameter_parse_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY parameter_target ALTER COLUMN id SET DEFAULT nextval('parameter_target_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY parameter_value ALTER COLUMN id SET DEFAULT nextval('parameter_value_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY request ALTER COLUMN id SET DEFAULT nextval('request_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY request_type ALTER COLUMN id SET DEFAULT nextval('request_type_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY scheme ALTER COLUMN id SET DEFAULT nextval('scheme_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval('user_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY websitemanagement ALTER COLUMN id SET DEFAULT nextval('websitemanagement_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY work ALTER COLUMN id SET DEFAULT nextval('work_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY work_progress ALTER COLUMN id SET DEFAULT nextval('work_progress_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY work_type ALTER COLUMN id SET DEFAULT nextval('work_type_id_seq'::regclass);


--
-- Data for Name: agency; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY agency (id, name_hi, name_en) FROM stdin;
\.


--
-- Name: agency_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('agency_id_seq', 1, false);


--
-- Data for Name: authassignment; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY authassignment (item_name, user_id, created_at) FROM stdin;
webadmin	1	1431962016
districtassign	1	1431968572
workadmin	1	1431968629
requestindex	1	1432094351
requestcreate	1	1432094356
requesttypeindex	1	1432097158
requesttypecreate	1	1432109587
parameterindex	1	1432188125
parametercreate	1	1432188144
parametervalueindex	1	1432199635
parametervalueform	1	1432206179
parametervaluepopulate	1	1432237169
parameterpopulate	1	1432242153
parameterupdate	1	1432242551
parameterdisplay	1	1432243035
\.


--
-- Data for Name: authitem; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY authitem (name, type, description, rule_name, data, created_at, updated_at) FROM stdin;
webadmin	1	\N	\N	\N	1431962015	1431962015
departmentedit	2	edit of controller department	\N	\N	1431962015	1431962015
departmentdelete	2	delete of controller department	\N	\N	1431962015	1431962015
departmentcreate	2	create of controller department	\N	\N	1431962015	1431962015
departmentview	2	view of controller department	\N	\N	1431962015	1431962015
departmentindex	2	index of controller department	\N	\N	1431962015	1431962015
departmentupdate	2	update of controller department	\N	\N	1431962015	1431962015
leveledit	2	edit of controller level	\N	\N	1431962015	1431962015
leveldelete	2	delete of controller level	\N	\N	1431962015	1431962015
levelcreate	2	create of controller level	\N	\N	1431962015	1431962015
levelview	2	view of controller level	\N	\N	1431962015	1431962015
levelindex	2	index of controller level	\N	\N	1431962015	1431962015
levelupdate	2	update of controller level	\N	\N	1431962015	1431962015
designationtypeedit	2	edit of controller designationtype	\N	\N	1431962015	1431962015
designationtypedelete	2	delete of controller designationtype	\N	\N	1431962016	1431962016
designationtypecreate	2	create of controller designationtype	\N	\N	1431962016	1431962016
designationtypeview	2	view of controller designationtype	\N	\N	1431962016	1431962016
designationtypeindex	2	index of controller designationtype	\N	\N	1431962016	1431962016
designationtypeupdate	2	update of controller designationtype	\N	\N	1431962016	1431962016
designationedit	2	edit of controller designation	\N	\N	1431962016	1431962016
designationdelete	2	delete of controller designation	\N	\N	1431962016	1431962016
designationcreate	2	create of controller designation	\N	\N	1431962016	1431962016
designationview	2	view of controller designation	\N	\N	1431962016	1431962016
designationindex	2	index of controller designation	\N	\N	1431962016	1431962016
designationupdate	2	update of controller designation	\N	\N	1431962016	1431962016
workadmin	1	\N	\N	\N	1431963266	1431963266
workedit	2	edit of controller work	\N	\N	1431963266	1431963266
workdelete	2	delete of controller work	\N	\N	1431963266	1431963266
workcreate	2	create of controller work	\N	\N	1431963266	1431963266
workview	2	view of controller work	\N	\N	1431963266	1431963266
workindex	2	index of controller work	\N	\N	1431963266	1431963266
workupdate	2	update of controller work	\N	\N	1431963266	1431963266
work_progressedit	2	edit of controller work_progress	\N	\N	1431963266	1431963266
work_progressdelete	2	delete of controller work_progress	\N	\N	1431963266	1431963266
work_progresscreate	2	create of controller work_progress	\N	\N	1431963266	1431963266
work_progressview	2	view of controller work_progress	\N	\N	1431963266	1431963266
work_progressindex	2	index of controller work_progress	\N	\N	1431963266	1431963266
work_progressupdate	2	update of controller work_progress	\N	\N	1431963266	1431963266
work_typeedit	2	edit of controller work_type	\N	\N	1431963266	1431963266
work_typedelete	2	delete of controller work_type	\N	\N	1431963266	1431963266
work_typecreate	2	create of controller work_type	\N	\N	1431963266	1431963266
work_typeview	2	view of controller work_type	\N	\N	1431963266	1431963266
work_typeindex	2	index of controller work_type	\N	\N	1431963266	1431963266
work_typeupdate	2	update of controller work_type	\N	\N	1431963266	1431963266
schemeedit	2	edit of controller scheme	\N	\N	1431963266	1431963266
schemedelete	2	delete of controller scheme	\N	\N	1431963266	1431963266
schemecreate	2	create of controller scheme	\N	\N	1431963266	1431963266
schemeview	2	view of controller scheme	\N	\N	1431963266	1431963266
schemeindex	2	index of controller scheme	\N	\N	1431963266	1431963266
schemeupdate	2	update of controller scheme	\N	\N	1431963266	1431963266
districtedit	2	edit of controller district	\N	\N	1431963266	1431963266
districtdelete	2	delete of controller district	\N	\N	1431963266	1431963266
districtcreate	2	create of controller district	\N	\N	1431963266	1431963266
districtview	2	view of controller district	\N	\N	1431963266	1431963266
districtindex	2	index of controller district	\N	\N	1431963266	1431963266
districtupdate	2	update of controller district	\N	\N	1431963266	1431963266
blockedit	2	edit of controller block	\N	\N	1431963266	1431963266
blockdelete	2	delete of controller block	\N	\N	1431963266	1431963266
blockcreate	2	create of controller block	\N	\N	1431963266	1431963266
blockview	2	view of controller block	\N	\N	1431963266	1431963266
blockindex	2	index of controller block	\N	\N	1431963266	1431963266
blockupdate	2	update of controller block	\N	\N	1431963266	1431963266
panchayatedit	2	edit of controller panchayat	\N	\N	1431963266	1431963266
panchayatdelete	2	delete of controller panchayat	\N	\N	1431963266	1431963266
panchayatcreate	2	create of controller panchayat	\N	\N	1431963266	1431963266
panchayatview	2	view of controller panchayat	\N	\N	1431963266	1431963266
panchayatindex	2	index of controller panchayat	\N	\N	1431963266	1431963266
panchayatupdate	2	update of controller panchayat	\N	\N	1431963266	1431963266
villageedit	2	edit of controller village	\N	\N	1431963266	1431963266
villagedelete	2	delete of controller village	\N	\N	1431963266	1431963266
villagecreate	2	create of controller village	\N	\N	1431963266	1431963266
villageview	2	view of controller village	\N	\N	1431963266	1431963266
villageindex	2	index of controller village	\N	\N	1431963266	1431963266
villageupdate	2	update of controller village	\N	\N	1431963266	1431963266
districtassign	1	\N	\N	\N	1431968572	1431968572
requestindex	1	\N	\N	\N	1432094351	1432094351
requestcreate	1	\N	\N	\N	1432094356	1432094356
requesttypeindex	1	\N	\N	\N	1432097158	1432097158
requesttypecreate	1	\N	\N	\N	1432109587	1432109587
parameterindex	1	\N	\N	\N	1432188125	1432188125
parametercreate	1	\N	\N	\N	1432188144	1432188144
parametervalueindex	1	\N	\N	\N	1432199635	1432199635
parametervalueform	1	\N	\N	\N	1432206179	1432206179
parametervaluepopulate	1	\N	\N	\N	1432237169	1432237169
parameterpopulate	1	\N	\N	\N	1432242153	1432242153
parameterupdate	1	\N	\N	\N	1432242551	1432242551
parameterdisplay	1	\N	\N	\N	1432243035	1432243035
\.


--
-- Data for Name: authitemchild; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY authitemchild (parent, child) FROM stdin;
webadmin	departmentedit
webadmin	departmentdelete
webadmin	departmentcreate
webadmin	departmentview
webadmin	departmentindex
webadmin	departmentupdate
webadmin	leveledit
webadmin	leveldelete
webadmin	levelcreate
webadmin	levelview
webadmin	levelindex
webadmin	levelupdate
webadmin	designationtypeedit
webadmin	designationtypedelete
webadmin	designationtypecreate
webadmin	designationtypeview
webadmin	designationtypeindex
webadmin	designationtypeupdate
webadmin	designationedit
webadmin	designationdelete
webadmin	designationcreate
webadmin	designationview
webadmin	designationindex
webadmin	designationupdate
workadmin	workedit
workadmin	workdelete
workadmin	workcreate
workadmin	workview
workadmin	workindex
workadmin	workupdate
workadmin	work_progressedit
workadmin	work_progressdelete
workadmin	work_progresscreate
workadmin	work_progressview
workadmin	work_progressindex
workadmin	work_progressupdate
workadmin	work_typeedit
workadmin	work_typedelete
workadmin	work_typecreate
workadmin	work_typeview
workadmin	work_typeindex
workadmin	work_typeupdate
workadmin	schemeedit
workadmin	schemedelete
workadmin	schemecreate
workadmin	schemeview
workadmin	schemeindex
workadmin	schemeupdate
workadmin	districtedit
workadmin	districtdelete
workadmin	districtcreate
workadmin	districtview
workadmin	districtindex
workadmin	districtupdate
workadmin	blockedit
workadmin	blockdelete
workadmin	blockcreate
workadmin	blockview
workadmin	blockindex
workadmin	blockupdate
workadmin	panchayatedit
workadmin	panchayatdelete
workadmin	panchayatcreate
workadmin	panchayatview
workadmin	panchayatindex
workadmin	panchayatupdate
workadmin	villageedit
workadmin	villagedelete
workadmin	villagecreate
workadmin	villageview
workadmin	villageindex
workadmin	villageupdate
\.


--
-- Data for Name: authrule; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY authrule (name, data, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: block; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY block (block_code, block_name, district_code) FROM stdin;
3117018	PAHASU	3117
3154010	BRAHMPUR	3154
3172006	motichak	3172
3171005	Chandauli   	3171
3131011	SIKANDARPUR KARAN	3131
3139001	MOTH	3139
3163006	MYORPUR	3163
3117027	DIBAI	3117
3141020	SUMERPUR	3141
3160008	GHAZIPUR	3160
3171004	Niyamatabad       	3171
3143007	HASWA	3143
3137009	BHITARGAON	3137
3148014	PUREDALAI	3148
3112002	MUZAFFARABAD	3112
3146003	BALAHA	3146
3128008	MITAULI	3128
3114010	BUDHANA	3114
3122011	NIDHAULI KALAN	3122
3129014	BISWAN	3129
3136009	DERAPUR	3136
3143012	VIJAYIPUR	3143
3157016	PHULPUR	3157
3160006	VIRNO	3160
3115012	PARIKSHITGARH	3115
3148006	BANKI	3148
3120012	FATEHABAD	3120
3120002	ACHHNERA	3120
3147021	WAZIRGANJ	3147
3138002	KUTHAUND	3138
3136008	SANDALPUR	3136
3146017	JARWAL	3146
3157006	BILARIYAGANJ	3157
3110016	DINGARPUR	3110
3114005	CHARTHAWAL	3114
3120006	KHANDAULI	3120
3125024	BITHIRI CHAINPUR	3125
3158029	MARIYAHU	3158
3170002	Nevada	3170
3158035	JALAL PUR	3158
3156005	KOPAGANJ	3156
3144016	LALGANJ	3144
3157020	MEHNAGAR	3157
3130033	KACHHAUNA	3130
3124008	DEHGAWAN	3124
3133005	TILOI	3181
3138005	NADIGAON	3138
3163001	GHORAWAL	3163
3172012	tamkuhiraj	3172
3145011	MAUAIMA	3145
3135022	BHARTHANA	3135
3159030	Hanumanganj	3159
3122012	SHITALPUR	3122
3110002	DILARI	3110
3163004	NAGWA	3163
3126007	PURANPUR	3126
3155024	BHATNI	3155
3159022	Navanagar	3159
3150029	MOTIGARPUR	3150
3125018	BHUTA	3125
3176005	HARIHARPUR RANI	3176
3157003	AHIRAULA	3157
3137005	KAKWAN	3137
3118014	GANGIRI	3118
3117019	SIKANDRABAD	3117
3163007	DUDHI	3163
3125022	FARIDPUR	3125
3130038	MADHOGANJ	3130
3123008	ALAO	3123
3126002	MARORI	3126
3169003	ACHCHALDA	3169
3115008	SARDHANA	3115
3143006	BHITAURA	3143
3178007	Jahangir Ganj	3178
3149020	Rudauli	3149
3116010	GARH MUKTESHWAR	3182
3118013	BIJAULI	3118
3160002	MANIHARI	3160
3160001	JAKHANIA	3160
3131004	SAFIPUR	3131
3130020	BHARAWAN	3130
3130024	BEHADAR	3130
3141023	RATH	3141
3178006	Ram Nagar	3178
3109004	HALDAUR(KHARI JHALU)	3109
3122002	KASGANJ	3180
3144003	KUNDA	3144
3138003	MADHOGARH	3138
3123007	BEWAR	3123
3150002	JAGDISHPUR	3181
3153002	GAUR	3153
3177002	MANIKPUR	3177
3120003	AKOLA	3120
3123009	KISHNI	3123
3129008	PARSENDI	3129
3157010	MOHAMMADPUR	3157
3126005	BILSANDA	3126
3145027	KORAON	3145
3151007	NAUGARH	3151
3121008	ARAON	3121
3133010	RAHI	3133
3147018	PARASPUR	3147
3168003	SAURIKH	3168
3123006	SULTANGANJ	3123
3130027	SURSA	3130
3128006	BANKEYGANJ	3128
3144001	KALAKANKAR	3144
3145019	HANDIA	3145
3162006	LALGANJ	3162
3111007	BILASPUR	3111
3126004	BARKHERA	3126
3124004	ASAFPUR	3124
3121007	SHIKOHABAD	3121
3148002	FATEHPUR	3148
3160014	ZAMANIA	3160
3125017	BHADPURA	3125
3153013	KUDARAHA	3153
3133006	BAHADURPUR	3181
3156007	RATANPURA	3156
3122003	AMANPUR	3180
3129009	KHAIRABAD	3129
3120009	KHERAGARH	3120
3148017	SIRAULI GAUSPUR	3148
3154092	CAMPIERGANJ	3154
3171001	Chahniya   	3171
3109005	Kotwali	3109
3178005	Baskhari	3178
3124018	USAWAN	3124
3127028	SINDHAULI	3127
3125028	RAMNAGAR	3125
3150024	BALDIRAI	3150
3157019	LALGANJ	3157
3117022	SYANA	3117
3155025	BHATPAR RANI	3155
3121006	JASRANA	3121
3128012	PHOOLBEHAR	3128
3144013	ASPUR DEOSARA	3144
3144012	PATTI	3144
3174007	SANTHA	3174
3155028	BHAGALPUR	3155
3175009	REHERA BAZAR	3175
3140002	JAKHAURA	3140
3151010	DOMARIYAGANJ	3151
3131003	FATEHPUR CHAURASI	3131
3109009	BUDHANPUR SEOHARA	3109
3169002	BIDHUNA	3169
3137001	KALYANPUR	3137
3132005	CHINHAT	3132
3158040	KHUTHAN	3158
3150009	BHETUA	3181
3153011	BANKATI	3153
3172010	seorahi	3172
3162012	JAMALPUR	3162
3124009	SAHASWAN	3124
3178010	BHITI	3178
3178009	Bhiyawan	3178
3145018	DHANUPUR	3145
3175003	TULSIPUR	3175
3109001	NAJIBABAD	3109
3150012	DHANPATGANJ	3150
3141022	MUSKARA	3141
3158032	RAM NAGAR	3158
3119009	RAYA	3119
3161028	Harahua	3161
3145021	SHANKARGARH	3145
3122004	SAHAWAR	3180
3132006	SAROJANINAGAR	3132
3116003	RAJAPUR	3116
3119004	GOVARDHAN	3119
3143013	DHATA	3143
3146001	MIHINPURWA	3146
3134006	MOHAMADABAD	3134
3156006	PARDAHA	3156
3145016	PRATAPPUR	3145
3157005	HARAIYA	3157
3148008	MASAULI	3148
3116004	LONI	3116
3149004	MAYA BAZAR	3149
3158036	SIRKONI	3158
3164003	Dadri	3164
3129007	HARGAON	3129
3125025	MAJHGAWAN	3125
3133003	MAHRAJGANJ	3133
3110015	MUNDA PANDEY	3110
3145010	HOLAGARH	3145
3159031	Dubhar	3159
3153014	DUBAULIYA	3153
3110011	SAMBHAL	3184
3134007	KAMALGANJ	3134
3152005	SISWA	3152
3159028	Garwar	3159
3130030	TONDARPUR	3130
3119003	CHAUMUHA	3119
3146010	VISHESHWARGANJ	3146
3153009	SAU GHAT	3153
3148009	SIDDHAUR	3148
3157015	PAWAI	3157
3158021	SUITHA KALA	3158
3172003	vishunpura	3172
3173002	BHADOHI	3173
3142002	TINDWARI	3142
3144018	PRATAPGARH (SADAR)	3144
3145012	SORAON	3145
3138009	KADAURA	3138
3138007	DAKORE	3138
3147016	HALDHARMAU	3147
3147012	PANDRI KRIPAL	3147
3148001	NINDURA	3148
3154011	KAURI RAM	3154
3165015	CHHAPRAULI	3165
3114001	UN	3183
3112005	SARSAWAN	3112
3130037	HARIYAWAN	3130
3168005	CHHIBRAMAU	3168
3137006	SHIVRAJPUR	3137
3117028	ARANIYA	3117
3124010	AMBIAPUR	3124
3129017	PAHALA	3129
3155017	DESAI DEORIA	3155
3168001	JALALABAD	3168
3120014	BAH	3120
3152010	PARTAWAL	3152
3169005	AJITMAL	3169
3169007	AURAIYA	3169
3127020	KALAN	3127
3143008	BAHUA	3143
3151002	ITWA	3151
3154018	BARHALGANJ	3154
3141024	GOHAND	3141
3117033	AGAUTA	3117
3115018	KHARKHODA	3115
3122007	SIDHPURA	3180
3144015	GAURA	3144
3147025	CHHAPIA	3147
3118002	CHANDAUS	3118
3125019	BAHERI	3125
3175011	HARYA SATGHARWA	3175
3160016	BHADAURA	3160
3174006	BAGHAULI	3174
3160005	DEVKALI	3160
3129001	PISAWAN	3129
3131012	ASOHA	3131
3159024	Maniar	3159
3148013	BANI KODAR	3148
3154007	PIPRAICH	3154
3109003	MOHAMMEDPUR DEOMAL	3109
3138008	MAHEVA	3138
3153005	KAPTANGANJ	3153
3142001	JASPURA	3142
3147010	RUPAIDEEH	3147
3127027	NIGOHI	3127
3146012	MAHASI	3146
3169006	BHAGYANAGAR	3169
3114009	KANDHLA	3183
3173060	ABHOLI	3173
3122013	SAKIT	3122
3128009	PASGAWAN	3128
3151008	JOGIA	3151
3143004	KHAJUHA	3143
3157004	MAHRAJGANJ	3157
3162005	PAHARI	3162
3169001	ERWA KATRA	3169
3177003	RAMNAGAR	3177
3109006	AFZALGARH	3109
3112007	GANGOH	3112
3129012	REUSA	3129
3172005	hata	3172
3128007	MOHAMMADI	3128
3129003	MISRIKH	3129
3146009	PRAYAGPUR	3146
3145009	KAURIHAR	3145
3157021	TARWA	3157
3166007	HASAYAN	3166
3110014	MORADABAD	3110
3117031	KHURJA	3117
3119008	MAT	3119
3158030	BARASATHI	3158
3136011	SARBANKHERA	3136
3117021	UNCHAGAON	3117
3148011	HAIDARGARH	3148
3150013	KUREBHAR	3150
3149007	HASTINGANJ	3149
3154012	BANSGAON	3154
3145023	KARCHHANA	3145
3128015	ISANAGAR	3128
3145026	MEJA	3145
3149009	TARUN	3149
3163005	CHOPAN	3163
3159034	Murlichhapra	3159
3150028	P.P.Kamaicha	3150
3160013	BHANWARKOL	3160
3133007	HARCHANDPUR	3133
3170007	kara	3170
3146014	PHAKHARPUR	3146
3114008	BAGHARA	3114
3118012	ATRAULI	3118
3139003	BAMAUR	3139
3145028	MANDA	3145
3112001	SADAULI QADEEM	3112
3150006	SHAHGARH	3181
3161024	Baragaon	3161
3167002	AMROHA	3167
3161026	Cholapur	3161
3116002	MURADNAGAR	3116
3123003	MAINPURI	3123
3126003	LALAURIKHERA	3126
3133009	SATAON	3133
3146007	CHITAURA	3146
3152009	PANIYARA	3152
3121002	FIROZABAD	3121
3112009	NAGAL	3112
3121004	EKA	3121
3133016	DIH	3133
3154014	GAUGAHA	3154
3135021	BARHPURA	3135
3158024	BADLA PUR	3158
3159019	NAGRA	3159
3163003	CHATRA	3163
3175010	BALRAMPUR	3175
3160004	SAIDPUR	3160
3140005	MEHRAUNI	3140
3165016	BINAULI	3165
3151006	BIRDPUR	3151
3149001	SOHAWAL	3149
3150022	KADIPUR	3150
3175004	GAISRI	3175
3129011	BEHTA	3129
3168007	HASERAN	3168
3172002	khadda	3172
3129006	AILIYA	3129
3151013	KHESRAHA	3151
3152007	MAHRAJGANJ	3152
3116005	DHAULANA	3182
3158034	MUFTI GANJ	3158
3176003	GILAULA	3176
3144004	BIHAR	3144
3152002	LAKSHMIPUR	3152
3128010	BEHJAM	3128
3141025	SARILA	3141
3155026	BANKATA	3155
3135018	TAKHA	3135
3166003	MURSAN	3166
3161031	Kashi Vidyapeeth	3161
3117029	JAHANGIRABAD	3117
3122014	JAITHARA	3122
3145024	KAUDHIYARA	3145
3123005	KARHAL	3123
3133018	SALON	3133
3154002	SAHJANAWA	3154
3116008	HAPUR	3182
3134008	BARHPUR	3134
3140004	BIRDHA	3140
3172001	padrauna	3172
3130025	BILGRAM	3130
3139007	BABINA	3139
3174004	NATH NAGAR	3174
3159020	Rasra	3159
3169004	SAHAR	3169
3127021	KHUDAGANJ KATRA	3127
3154005	CHIRGAWAN	3154
3110012	PANWASA	3184
3139006	MAURANIPUR	3139
3147023	MANKAPUR	3147
3140006	MADAWARA	3140
3114007	MUZAFFARNAGAR	3114
3131006	MIANGANJ	3131
3132002	MAL	3132
3137011	VIDHUNU	3137
3140001	TALBEHAT	3140
3121005	KHERGARH	3121
3157013	SATHIYAON	3157
3166002	HATHRAS	3166
3121009	MADANPUR	3121
3124007	WAZIRGANJ	3124
3127023	JALALABAD	3127
3150019	AKHAND NAGAR	3150
3124012	JAGAT	3124
3115015	JANIKHURD	3115
3147022	NAWABGANJ	3147
3151011	BANSI	3151
3110010	ASMAULI	3184
3126001	AMARIYA	3126
3145017	SAIDABAD	3145
3129015	KASMANDA	3129
3135023	SEFAI	3135
3170005	manjhanpur	3170
3128013	NAKAHA	3128
3179004	KABRAI	3179
3131002	BANGARMAU	3131
3152003	NICHLAUL	3152
3148005	DEWA	3148
3127025	TILHAR	3127
3142004	BABERU	3142
3167001	HASANPUR	3167
3125026	RICHHA	3125
3133012	SARENI	3133
3133017	CHHATOH	3133
3151005	SHOHARATGARH	3151
3151012	MITHWAL	3151
3155029	LAR	3155
3117025	BHAWAN BAHADUR NAGAR	3117
3133011	KHIRON	3133
3145013	BAHRIA	3145
3177001	PAHARI	3177
3154003	PIPRAULI	3154
3162003	MAJHAWA	3162
3124013	UJHANI	3124
3137007	CHAUBEYPUR	3137
3124016	DATAGANJ	3124
3143005	TELYANI	3143
3174001	HAISAR BAZAR	3174
3158037	KERAKAT	3158
3153007	SALTAUA GOPAL PUR	3153
3155018	PATHARDEWA	3155
3157012	PALHANI	3157
3170004	kaushambi	3170
3120010	SAIYAN	3120
3110001	THAKURDWARA	3110
3165013	BARAUT	3165
3122010	MAREHRA	3122
3123004	BARNAHAL	3123
3162010	SHIKHAR	3162
3174009	BELHAR KALA	3174
3127017	DADROL	3127
3139002	CHIRGAON	3139
3163002	ROBERTSGANJ	3163
3167005	JOYA	3167
3128004	KUMBHIGOLA	3128
3162002	KON	3162
3121003	TUNDLA	3121
3129016	SIDHAULI	3129
3134003	SHAMSABAD	3134
3161027	Chiraigaon	3161
3110013	BHAGATPUR TANDA	3110
3149003	PURA BAZAR	3149
3119005	MATHURA	3119
3151001	KHUNIYAON	3151
3153006	RAMNAGAR	3153
3167006	DHANAURA	3167
3132001	MALIHABAD	3132
3171009	Naugarh    	3171
3133004	SINGHPUR	3181
3133021	DEENSHAH GAURA	3133
3150015	KURWAR	3150
3123001	GHIROR	3123
3157018	THEKMA	3157
3159033	Bairia	3159
3130022	AHRORI	3130
3133019	UNCHAHAR	3133
3150026	DUBEPUR	3150
3116009	SIMBHAWALI	3182
3125023	FATEHGANJ WEST	3125
3151014	LOTAN	3151
3110018	BILARI	3110
3145014	PHULPUR	3145
3159021	CHILKAHAR	3159
3149005	AMANIGANJ	3149
3158031	DHARMA PUR	3158
3119002	CHHATA	3119
3117024	DANPUR	3117
3125020	BHOJIPURA	3125
3158023	KARANJA KALA	3158
3144017	BABA BELKHARNATH DHAM	3144
3147017	COLONELGANJ	3147
3156008	MOHAMMADABAD GOHANA	3156
3162007	HALLIA	3162
3174002	KHALILABAD	3174
3125027	NAWABGANJ	3125
3115014	ROHTA	3115
3124003	JUNAWAI	3184
3127015	BANDA	3127
3150001	SHUKUL BAZAR	3181
3152011	DHANI	3152
3130036	PIHANI	3130
3144007	LAKSHAMANPUR	3144
3110004	CHHAJLET	3110
3112006	NAKUR	3112
3158025	MAHARAJ GANJ	3158
3173004	Gyanpur	3173
3176004	SIRSIYA	3176
3114006	PURKAJI	3114
3151003	BHANWAPUR	3151
3136013	MALASA	3136
3145025	URUWAN	3145
3149008	BIKAPUR	3149
3155027	SALEMPUR	3155
3146016	KAISARGANJ	3146
3166005	SEHPAU	3166
3109012	ALLAHPUR	3109
3129002	MAHOLI	3129
3118003	KHAIR	3118
3129018	MAHMUDABAD	3129
3150005	JAMO	3181
3165011	BAGHPAT	3165
3156004	BADRAON	3156
3109010	JALILPUR	3109
3116001	BHOJPUR	3116
3130031	TADIYAWAN	3130
3150018	DOSTPUR	3150
3127016	BHAWAL KHERA	3127
3137010	GHATAMPUR	3137
3154017	GOLA	3154
3175006	SHRIDUTTGANJ	3175
3135016	MAHEWA	3135
3148004	RAMNAGAR	3148
3165020	PILANA	3165
3125029	SHERGARH	3125
3131001	GANJ MORADABAD	3131
3172004	nebua naurangia	3172
3174003	MEHDAWAL	3174
3159032	Belhari	3159
3122006	PATIYALI	3180
3148007	HARAKH	3148
3117032	LAKHAOTHI	3117
3173003	Aurai	3173
3142006	BISANDA	3142
3160010	KASIMABAD	3160
3161029	Sevapuri	3161
3119006	FARAH	3119
3154006	BHATHAT	3154
3111003	SAIDNAGAR	3111
3130029	SHAHABAD	3130
3150008	AMETHI	3181
3150025	JAISINGHPUR	3150
3128001	PALIA	3128
3155016	BAITALPUR	3155
3114003	SHAMLI	3183
3123002	KURAOLI	3123
3158039	DOBHI	3158
3136005	RASULABAD	3136
3162001	CHHANVEY	3162
3179001	PANWARI	3179
3150011	SANGRAMPUR	3181
3170001	chail	3170
3115010	MAWANA KALAN	3115
3118008	IGLAS	3118
3153008	RUDAULI	3153
3139008	BADAGAON	3139
3147013	JHANJHARI	3147
3133013	LALGANJ	3133
3129010	LAHARPUR	3129
3167003	GAJRAULA	3167
3159026	Bansdih	3159
3153003	HARRAIYA	3153
3127024	MIRZAPUR	3127
3151009	USKA BAZAR	3151
3153004	VIKRAM JOT	3153
3125031	AALAMPUR JAFARABAD	3125
3158026	SUJAN GANJ	3158
3144005	SANGIPUR	3144
3157022	PALHANA	3157
3154009	KHORABAR	3154
3131008	NAWABGANJ	3131
3154015	KHAJANI	3154
3179003	CHARKHARI	3179
3114014	KHATAULI	3114
3124006	BISAULI	3124
3125030	MIRGANJ	3125
3131007	HASANGANJ	3131
3145022	CHAKA	3145
3146013	TAJWAPUR	3146
3172011	kasaya	3172
3128014	DHAUREHRA	3128
3131015	BIGHAPUR	3131
3172008	kaptainganj	3172
3158038	BAKSHA	3158
3109002	KIRATPUR	3109
3115016	MEERUT	3115
3118006	DHANIPUR	3118
3124017	MION	3124
3133015	JAGATPUR	3133
3158028	MACHCHALI SHAHAR	3158
3158033	RAM PUR	3158
3115017	RAJPURA	3115
3144002	BABAGANJ	3144
3177005	Karwi	3177
3155023	BARHAJ	3155
3128005	BIJUA	3128
3134004	RAJEPUR	3134
3160015	REVATIPUR	3160
3177006	Mau	3177
3127022	JAITPUR	3127
3118007	GONDA	3118
3143010	HATHGAON	3143
3154001	PALI	3154
3114004	KAIRANA	3183
3134002	NAWABGANJ	3134
3155020	DEORIA SADAR	3155
3124001	RAJPURA	3184
3130035	MALLAWAN	3130
3135017	BASREHAR	3135
3155022	BHALUANI	3155
3114012	MORNA	3114
3135020	JASWANTNAGAR	3135
3150027	BHADAIYA	3150
3127029	MADNAPUR	3127
3131009	SIKANDARPUR SARAUSI	3131
3158041	SIKRARA	3158
3147011	ITIATHOK	3147
3174008	PAULI	3174
3109007	NEHTAUR	3109
3112003	PUWARKA	3112
3143002	MALWAN	3143
3166001	Sasni	3166
3157011	RANI KI SARAI	3157
3176002	EKONA	3176
3124015	SAMRER	3124
3118004	JAWAN SIKANDERPUR	3118
3174005	SEMARIYAWAN	3174
3163008	BABHANI	3163
3117030	GULAOTHI	3117
3122008	JALESAR	3122
3128011	LAKHIMPUR	3128
3142005	KAMASIN	3142
3170006	sarsawan	3170
3144006	RAMPUR SANRAMGARH	3144
3150023	BHADAR	3181
3148003	SURATGANJ	3148
3172013	fazilnagar	3172
3131016	SUMERPUR	3131
3111001	SUAR	3111
3132007	GOSAIGANJ	3132
3153001	PARAS RAMPUR	3153
3129019	RAMPUR MATHURA	3129
3130034	HARPALPUR	3130
3147019	BELSAR	3147
3149019	MAWAI	3149
3168002	UMARDA	3168
3157002	KOILSA	3157
3111005	SHAHABAD	3111
3167004	GANGESHWARI	3167
3124014	QADAR CHOWK	3124
3150003	MUSAFIR KHANA	3181
3126006	BISALPUR	3126
3127019	KHUTAR	3127
3146015	HUZOORPUR	3146
3122001	SORON	3180
3157009	MIRZAPUR	3157
3142003	BADOKHAR KHURD	3142
3148012	DARIYABAD	3148
3114013	JANSATH	3114
3133014	DALMAU	3133
3120011	SHAMSABAD	3120
3112010	NANAUTA	3112
3178003	Akbarpur	3178
3172007	sukrauli	3172
3118001	TAPPAL	3118
3155019	RAMPUR KARKHANA	3155
3115013	MACHRA	3115
3139004	GURSARAI	3139
3154008	SARDARNAGAR	3154
3137003	SARSOL	3137
3171007	Barhani	3171
3129004	MACHHREHTA	3129
3147024	BABHANJOT	3147
3166006	SIKANDRARAO	3166
3117023	ANUPSHAHR	3117
3136010	AKBARPUR	3136
3132004	KAKORI	3132
3164001	Dankaur	3164
3141021	MAUDAHA	3141
3157008	TAHBARPUR	3157
3155021	RUDRAPUR	3155
3135027	CHAKARNAGAR	3135
3178008	Jalal Pur	3178
3146005	RISIA	3146
3138001	RAMPURA	3138
3147020	TARABGANJ	3147
3164005	Bisrakh	3164
3168008	Gugrapur	3168
3175008	GAINDAS BUJURG	3175
3112004	BALLIA KHERI	3112
3137008	PATARA	3137
3159023	Pandah	3159
3157017	MARTINGANJ	3157
3136007	MAITHA	3136
3140003	BAR	3140
3144008	SANDWA CHANDRIKA	3144
3111004	CHAMRAON	3111
3112011	DEOBAND	3112
3160012	MOHAMMADABAD	3160
3115011	HASTINAPUR	3115
3161030	Arajiline	3161
3172009	ramkola	3172
3168004	KANNAUJ	3168
3122015	ALIGANJ	3122
3170008	sirathu	3170
3153010	BASTI	3153
3137004	BILHAUR	3137
3120015	JAITPUR KALAN	3120
3157001	ATRAULIA	3157
3146002	NAWABGANJ	3146
3122005	GANJ DUNDWARA	3180
3124002	GUNNAUR	3184
3152004	MITHAURA	3152
3143001	DEVMAI	3143
3173005	Deegh	3173
3121001	NARKHI	3121
3128002	NIGHASAN	3128
3154016	BELGHAT	3154
3129005	GONDLAMAU	3129
3159018	SIAR	3159
3120004	BICHPURI	3120
3152001	NAUTANWA	3152
3157007	AZMATGARH	3157
3159027	Reoti	3159
3153012	BAHADURPUR	3153
3114011	SHAHPUR	3114
3118015	AKRABAD	3118
3133001	BACHHRAWAN	3133
3117020	SHIKARPUR	3117
3136012	RAJPUR	3136
3138006	KONCH	3138
3128003	RAMIA BEHAR	3128
3162011	NARAINPUR	3162
3111006	MILAK	3111
3120013	PINAHAT	3120
3144010	MANDHATA	3144
3119010	BALDEO	3119
3136006	JHINJHAK	3136
3114002	THANA BHAWAN	3183
3156002	FATEHPUR MADAUN	3156
3132003	BAKSHI-KA-TALAB	3132
3176001	JAMUNAHA	3176
3149002	MASODHA	3149
3150030	KARAUDI KALAN	3150
3178002	Katehari	3178
3158027	MUNGRA BADSHAH PUR	3158
3166004	SADABAD	3166
3142007	MAHUVA	3142
3144011	MAGRAURA	3144
3134001	KAIMGANJ	3134
3149006	MILKIPUR	3149
3130028	SANDILA	3130
3139005	BANGRA	3139
3155015	GAURI BAZAR	3155
3171002	Sakaldiha	3171
3120001	FATEHPUR SIKRI	3120
3171003	Dhanapur	3171
3118005	LODHA	3118
3142008	NARAINI	3142
3143014	ASODHAR	3143
3110017	BANIYAKHERA	3184
3168006	TALGRAM	3168
3125021	KYARA	3125
3129013	SAKRAN	3129
3162009	RAJGARH	3162
3164004	Jewar	3164
3120007	ETMADPUR	3120
3127026	POWAYAN	3127
3127018	KANTH	3127
3132008	MOHANLALGANJ	3132
3115007	SARURPUR KHURD	3115
3159029	Sohanv	3159
3172014	DUDHAHI	3172
3179002	JAITPUR	3179
3130023	BHARKHANI	3130
3124011	SALARPUR	3124
3158022	SHAH GANJ	3158
3115009	DAURALA	3115
3131013	HILAULI	3131
3154013	URUWA	3154
3130021	BAWAN	3130
3145020	JASRA	3145
3131010	BICHHIYA	3131
3130032	KOTHWAN	3130
3131005	AURAS	3131
3122009	AWAGARH	3122
3120008	JAGNER	3120
3175007	UTRAULA	3175
3171006	Chakiya	3171
3148010	TRIVEDIGANJ	3148
3162004	CITY (NAGAR)	3162
3178004	Tanda	3178
3119001	NANDGAON	3119
3154004	JANGAL KODIA	3154
3152008	GHUGHULI	3152
3120005	BARAULI AHIR	3120
3152006	BRIDGEMANGANJ	3152
3156003	GHOSI	3156
3170003	mooratganj	3170
3157014	JAHANAGANJ	3157
3146004	SHIVPUR	3146
3145015	BAHADURPUR	3145
3110019	BAHJOI	3184
3175005	PACHPEDWA	3175
3160007	MARDAH	3160
3138004	JALAUN	3138
3117026	BULANDSHAHR	3117
3155030	TARKULWA	3155
3162008	PATEHRA KALA	3162
3147014	MUJEHANA	3147
3150007	GAURIGANJ	3181
3109011	NOORPUR	3109
3165019	KHEKRA	3165
3144014	SHIVGARH	3144
3133020	ROHANIA	3133
3160009	KARANDA	3160
3171008	Sahabganj   	3171
3131014	PURWA	3131
3141019	KURARA	3141
3147015	KATRA BAZAR	3147
3156001	DOHRI GHAT	3156
3133008	AMAWAN	3133
3156009	RANIPUR	3156
3143003	AMAULI	3143
3136014	AMRODHA	3136
3173001	Suriyavan	3173
3152013	PHARENDA	3152
3112008	RAMPUR MANIHARAN	3112
3160011	VARACHAKWAR	3160
3151004	BARHNI	3151
3133002	SHIVGARH	3133
3130026	SANDI	3130
3160003	SADAT	3160
3119007	NOHJHIL	3119
3124005	ISLAMNAGAR	3124
3150020	LAMBHUA	3150
3143011	AIRAYA	3143
3159025	Beruarbari	3159
3161025	Pindra	3161
\.


--
-- Data for Name: department; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY department (id, name_hi, name_en, created_at, updated_at) FROM stdin;
1	WebAdministration	WebAdministration	1431962015	1431962015
\.


--
-- Name: department_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('department_id_seq', 1, true);


--
-- Data for Name: designation; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY designation (id, designation_type_id, level_id, officer_name_hi, officer_name_en, officer_mobile, officer_mobile1, officer_email, officer_userid, name_hi, name_en, created_at, updated_at) FROM stdin;
1	1	1	\N	\N	\N	\N	\N	1	Web Administrator Web Manager	Web Administrator Web Manager	1431962015	1431962015
\.


--
-- Name: designation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('designation_id_seq', 1, true);


--
-- Data for Name: designation_type; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY designation_type (id, level_id, name_hi, name_en, shortcode, created_at, updated_at) FROM stdin;
1	1	Web Administrator	Web Administrator	webadmin	1431962015	1431962015
\.


--
-- Name: designation_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('designation_type_id_seq', 1, true);


--
-- Data for Name: district; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY district (district_code, district_name) FROM stdin;
3149	FAIZABAD
3111	RAMPUR
3145	ALLAHABAD
3167	AMROHA
3172	KUSHI NAGAR
3136	KANPUR DEHAT
3118	ALIGARH
3142	BANDA
3162	MIRZAPUR
3179	MAHOBA
3126	PILIBHIT
3147	GONDA
3159	BALLIA
3180	KASHGANJ
3109	BIJNOR
3124	BUDAUN
3181	AMETHI
3116	GHAZIABAD
3128	KHERI
3141	HAMIRPUR
3148	BARABANKI
3169	AURAIYA
3119	MATHURA
3132	LUCKNOW
3131	UNNAO
3164	GAUTAM BUDDHA NAGAR
3184	SAMBHAL
3134	FARRUKHABAD
3168	KANNAUJ
3135	ETAWAH
3171	CHANDAULI
3163	SONBHADRA
3143	FATEHPUR
3176	SHRAVASTI
3182	HAPUR
3127	SHAHJAHANPUR
3133	RAE BARELI
3157	AZAMGARH
3120	AGRA
3144	PRATAPGARH
3117	BULANDSHAHR
3125	BAREILLY
3183	SHAMLI
3174	SANT KABEER NAGAR
3170	KAUSHAMBI
3154	GORAKHPUR
3166	HATHRAS
3112	SAHARANPUR
3178	AMBEDKAR NAGAR
3115	MEERUT
3175	BALRAMPUR
3177	CHITRAKOOT
3161	VARANASI
3121	FIROZABAD
3140	LALITPUR
3146	BAHRAICH
3150	SULTANPUR
3138	JALAUN
3155	DEORIA
3129	SITAPUR
3158	JAUNPUR
3123	MAINPURI
3151	SIDDHARTH NAGAR
3156	MAU
3114	MUZAFFARNAGAR
3139	JHANSI
3173	SANT RAVIDAS NAGAR
3152	MAHARAJGANJ
3130	HARDOI
3153	BASTI
3122	ETAH
3137	KANPUR NAGAR
3110	MORADABAD
3160	GHAZIPUR
3165	BAGHPAT
\.


--
-- Data for Name: level; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY level (id, dept_id, name_hi, name_en, class_name, created_at, updated_at) FROM stdin;
1	1	Web Administration	Web Administration	app\\modules\\users\\models\\WebsiteManagement	1431962015	1431962015
\.


--
-- Name: level_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('level_id_seq', 1, true);


--
-- Data for Name: marking; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY marking (id, request_id, sender, receiver, dateofmarking, deadline, create_time, update_time, read_time) FROM stdin;
\.


--
-- Name: marking_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('marking_id_seq', 1, false);


--
-- Data for Name: migration; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY migration (version, apply_time) FROM stdin;
m000000_000000_base	1431961795
m140506_102106_rbac_init	1431962000
m150430_041205_create_designation_designation_type_level	1431962016
m150506_185842_create_tables_work	1431963266
m150520_022511_create_mnrega_tables	1432094158
m150521_054805_create_tables_parameters	1432242079
\.


--
-- Data for Name: panchayat; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY panchayat (district_code, block_code, code, name_hi, name_en, census_code) FROM stdin;
\.


--
-- Data for Name: parameter; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY parameter (id, type, link, parser, name_hi, name_en, shortcode, description, weight, unit) FROM stdin;
1	0	http://164.100.129.6/netnrega/projected_VS_generated.aspx?file1=empprov&page1=s&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&fin_year=2015-2016&Digest=CgyzEo8dpRYpwcFbitdqJg	\N	रोज़गार 	Persondays (Monthwise)	mandays		10	No
2	0	http://164.100.129.6/netnrega/projected_VS_generated.aspx?file1=empprov&page1=s&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&fin_year=2015-2016&Digest=CgyzEo8dpRYpwcFbitdqJg	\N	रोज़गार लक्ष्य 	Persondays (Monthwise) Target	mandaystarget	target upto current month	10	No
\.


--
-- Name: parameter_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('parameter_id_seq', 2, true);


--
-- Data for Name: parameter_parse; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY parameter_parse (id, parameter_id, json_value, update_time, dld_data, level, district_code) FROM stdin;
1	1	{"AGRA":{"4":{"mandays":"36410","per":71.930933659963},"5":{"mandays":"65679","per":43.57018236336}},"ALIGARH":{"4":{"mandays":"8592","per":18.58774662513},"5":{"mandays":"13913","per":7.1499784159352}},"ALLAHABAD":{"4":{"mandays":"104544","per":60.267718169555},"5":{"mandays":"120864","per":29.651800368489}},"AMBEDKAR NAGAR":{"4":{"mandays":"115630","per":97.794279334901},"5":{"mandays":"143816","per":50.001738392752}},"AMETHI":{"4":{"mandays":"87862","per":75.363686269128},"5":{"mandays":"152171","per":49.834617097645}},"AMROHA":{"4":{"mandays":"73618","per":297.15831113264},"5":{"mandays":"138766","per":87.738288684172}},"AURAIYA":{"4":{"mandays":"19206","per":49.284064665127},"5":{"mandays":"29132","per":17.811200782587}},"AZAMGARH":{"4":{"mandays":"132177","per":74.15966740166},"5":{"mandays":"184543","per":33.204026736958}},"BAGHPAT":{"4":{"mandays":"1650","per":38.951841359773},"5":{"mandays":"1950","per":12.214218603194}},"BAHRAICH":{"4":{"mandays":"61515","per":28.702809389829},"5":{"mandays":"85219","per":14.084551270715}},"BALLIA":{"4":{"mandays":"14977","per":25.230795148248},"5":{"mandays":"25430","per":10.024914455115}},"BALRAMPUR":{"4":{"mandays":"10130","per":8.2118045704002},"5":{"mandays":"16205","per":5.1187046723776}},"BANDA":{"4":{"mandays":"91199","per":56.269281078013},"5":{"mandays":"113321","per":33.152049897315}},"BARABANKI":{"4":{"mandays":"58217","per":38.645672218424},"5":{"mandays":"63687","per":15.497354935102}},"BAREILLY":{"4":{"mandays":"27467","per":62.118642151209},"5":{"mandays":"36230","per":24.45428405578}},"BASTI":{"4":{"mandays":"64876","per":39.892269473891},"5":{"mandays":"144514","per":20.164594123951}},"BIJNOR":{"4":{"mandays":"54220","per":140.75073983698},"5":{"mandays":"77043","per":36.518289243545}},"BUDAUN":{"4":{"mandays":"37318","per":54.323395830907},"5":{"mandays":"43917","per":20.987011249271}},"BULANDSHAHR":{"4":{"mandays":"6077","per":40.322473624842},"5":{"mandays":"10887","per":18.835640138408}},"CHANDAULI":{"4":{"mandays":"29279","per":161.42353070901},"5":{"mandays":"45747","per":27.733858745074}},"CHITRAKOOT":{"4":{"mandays":"69975","per":61.288034053287},"5":{"mandays":"80301","per":37.943515425288}},"DEORIA":{"4":{"mandays":"47750","per":56.851329309093},"5":{"mandays":"53063","per":17.281662801907}},"ETAH":{"4":{"mandays":"12571","per":31.769016932019},"5":{"mandays":"21513","per":16.183462221286}},"ETAWAH":{"4":{"mandays":"10070","per":23.780286213574},"5":{"mandays":"12493","per":10.572951929587}},"FAIZABAD":{"4":{"mandays":"62112","per":37.611723386218},"5":{"mandays":"98054","per":27.665187300208}},"FARRUKHABAD":{"4":{"mandays":"6653","per":18.10389398351},"5":{"mandays":"9914","per":7.5425476069111}},"FATEHPUR":{"4":{"mandays":"21075","per":22.667871317479},"5":{"mandays":"25380","per":9.7099636163302}},"FIROZABAD":{"4":{"mandays":"26745","per":121.60134582159},"5":{"mandays":"39711","per":43.370612262729}},"GAUTAM BUDDHA NAGAR":{"4":{"mandays":"0","per":0},"5":{"mandays":"0","per":0}},"GHAZIABAD":{"4":{"mandays":"0","per":0},"5":{"mandays":"0","per":0}},"GHAZIPUR":{"4":{"mandays":"1436","per":1.4412172062868},"5":{"mandays":"5524","per":1.3694656753494}},"GONDA":{"4":{"mandays":"52250","per":22.601533876347},"5":{"mandays":"57536","per":10.975586492642}},"GORAKHPUR":{"4":{"mandays":"33652","per":15.445979005733},"5":{"mandays":"64982","per":9.7645637487077}},"HAMIRPUR":{"4":{"mandays":"36606","per":75.141637244437},"5":{"mandays":"64764","per":52.345120226308}},"HAPUR":{"4":{"mandays":"1201","per":188.24451410658},"5":{"mandays":"1201","per":20.400883302191}},"HARDOI":{"4":{"mandays":"75570","per":27.586131370874},"5":{"mandays":"106806","per":15.875606449772}},"HATHRAS":{"4":{"mandays":"7490","per":70.487483530962},"5":{"mandays":"12622","per":24.654269864833}},"JALAUN":{"4":{"mandays":"24580","per":40.416995527493},"5":{"mandays":"32894","per":13.920086667287}},"JAUNPUR":{"4":{"mandays":"161702","per":93.988200761429},"5":{"mandays":"199160","per":42.150532172691}},"JHANSI":{"4":{"mandays":"141360","per":90.581126368873},"5":{"mandays":"193279","per":52.207512972262}},"KANNAUJ":{"4":{"mandays":"33341","per":97.591031495141},"5":{"mandays":"47098","per":33.197296173338}},"KANPUR DEHAT":{"4":{"mandays":"17218","per":23.537292213473},"5":{"mandays":"22139","per":13.55094995593}},"KANPUR NAGAR":{"4":{"mandays":"58491","per":106.82702317681},"5":{"mandays":"70764","per":55.14178179863}},"KASHGANJ":{"4":{"mandays":"8083","per":15.677489429381},"5":{"mandays":"11970","per":8.8087896561113}},"KAUSHAMBI":{"4":{"mandays":"9547","per":12.323639133073},"5":{"mandays":"11360","per":5.8217300172704}},"KHERI":{"4":{"mandays":"43719","per":42.429565504324},"5":{"mandays":"65083","per":17.375529611525}},"KUSHI NAGAR":{"4":{"mandays":"12651","per":8.0539091794575},"5":{"mandays":"30399","per":4.706980806035}},"LALITPUR":{"4":{"mandays":"126793","per":97.590880752446},"5":{"mandays":"166209","per":50.231803290579}},"LUCKNOW":{"4":{"mandays":"29303","per":97.390986439777},"5":{"mandays":"36274","per":25.798330085487}},"MAHARAJGANJ":{"4":{"mandays":"18279","per":11.71685704396},"5":{"mandays":"26200","per":3.6533398777386}},"MAHOBA":{"4":{"mandays":"13995","per":77.328986628357},"5":{"mandays":"23668","per":29.451730917598}},"MAINPURI":{"4":{"mandays":"7258","per":26.585106772646},"5":{"mandays":"13288","per":13.387199145669}},"MATHURA":{"4":{"mandays":"7504","per":25.061786119832},"5":{"mandays":"8086","per":9.4036377168907}},"MAU":{"4":{"mandays":"28913","per":22.290322331953},"5":{"mandays":"36513","per":11.48286988408}},"MEERUT":{"4":{"mandays":"1435","per":21.034887129874},"5":{"mandays":"5938","per":20.056067821799}},"MIRZAPUR":{"4":{"mandays":"31704","per":36.236041740482},"5":{"mandays":"43374","per":19.005678830582}},"MORADABAD":{"4":{"mandays":"27896","per":41.219321187405},"5":{"mandays":"40083","per":19.773373061289}},"MUZAFFARNAGAR":{"4":{"mandays":"5873","per":64.080741953082},"5":{"mandays":"7973","per":22.087708119788}},"PILIBHIT":{"4":{"mandays":"7881","per":8.1797235023041},"5":{"mandays":"10705","per":4.5599761458511}},"PRATAPGARH":{"4":{"mandays":"82066","per":78.777057835373},"5":{"mandays":"103023","per":40.381065116589}},"RAE BARELI":{"4":{"mandays":"72819","per":50.359617698723},"5":{"mandays":"106534","per":27.624530014262}},"RAMPUR":{"4":{"mandays":"1252","per":2.515420006831},"5":{"mandays":"8758","per":5.3483969465649}},"SAHARANPUR":{"4":{"mandays":"5818","per":38.911182450508},"5":{"mandays":"9401","per":15.3902822343}},"SAMBHAL":{"4":{"mandays":"28367","per":53.5135543021},"5":{"mandays":"46868","per":26.094024898114}},"SANT KABEER NAGAR":{"4":{"mandays":"42647","per":35.67473064311},"5":{"mandays":"62718","per":18.513500349796}},"SANT RAVIDAS NAGAR":{"4":{"mandays":"24136","per":50.655865007241},"5":{"mandays":"27584","per":26.6188022311}},"SHAHJAHANPUR":{"4":{"mandays":"68755","per":80.223793521889},"5":{"mandays":"94889","per":32.750271800093}},"SHAMLI":{"4":{"mandays":"2873","per":33.764249618051},"5":{"mandays":"3979","per":16.895248609401}},"SHRAVASTI":{"4":{"mandays":"21317","per":33.291166916542},"5":{"mandays":"24694","per":15.912312807691}},"SIDDHARTH NAGAR":{"4":{"mandays":"234680","per":71.40748944923},"5":{"mandays":"384203","per":40.470537426001}},"SITAPUR":{"4":{"mandays":"228247","per":101.89962141505},"5":{"mandays":"298512","per":45.850715457444}},"SONBHADRA":{"4":{"mandays":"88791","per":50.733075833067},"5":{"mandays":"106023","per":28.670362358031}},"SULTANPUR":{"4":{"mandays":"72137","per":49.379479351345},"5":{"mandays":"77214","per":28.740736329223}},"UNNAO":{"4":{"mandays":"55704","per":39.400755421636},"5":{"mandays":"90567","per":21.163480861803}},"VARANASI":{"4":{"mandays":"23335","per":57.860153731713},"5":{"mandays":"39753","per":27.127006223387}},"Total":{"4":{"mandays":"3370590","per":49.795519542281},"5":{"mandays":"4754075","per":23.912583131885}}}	1432242831	\N	\N	\N
2	1	{"AGRA":{"1":{"mandays":"36410","per":71.930933659963},"2":{"mandays":"65679","per":43.57018236336}},"ALIGARH":{"1":{"mandays":"8592","per":18.58774662513},"2":{"mandays":"13913","per":7.1499784159352}},"ALLAHABAD":{"1":{"mandays":"104544","per":60.267718169555},"2":{"mandays":"120864","per":29.651800368489}},"AMBEDKAR NAGAR":{"1":{"mandays":"115630","per":97.794279334901},"2":{"mandays":"143816","per":50.001738392752}},"AMETHI":{"1":{"mandays":"87862","per":75.363686269128},"2":{"mandays":"152171","per":49.834617097645}},"AMROHA":{"1":{"mandays":"73618","per":297.15831113264},"2":{"mandays":"138766","per":87.738288684172}},"AURAIYA":{"1":{"mandays":"19206","per":49.284064665127},"2":{"mandays":"29132","per":17.811200782587}},"AZAMGARH":{"1":{"mandays":"132177","per":74.15966740166},"2":{"mandays":"184543","per":33.204026736958}},"BAGHPAT":{"1":{"mandays":"1650","per":38.951841359773},"2":{"mandays":"1950","per":12.214218603194}},"BAHRAICH":{"1":{"mandays":"61515","per":28.702809389829},"2":{"mandays":"85219","per":14.084551270715}},"BALLIA":{"1":{"mandays":"14977","per":25.230795148248},"2":{"mandays":"25430","per":10.024914455115}},"BALRAMPUR":{"1":{"mandays":"10130","per":8.2118045704002},"2":{"mandays":"16205","per":5.1187046723776}},"BANDA":{"1":{"mandays":"91199","per":56.269281078013},"2":{"mandays":"113321","per":33.152049897315}},"BARABANKI":{"1":{"mandays":"58217","per":38.645672218424},"2":{"mandays":"63687","per":15.497354935102}},"BAREILLY":{"1":{"mandays":"27467","per":62.118642151209},"2":{"mandays":"36230","per":24.45428405578}},"BASTI":{"1":{"mandays":"64876","per":39.892269473891},"2":{"mandays":"144514","per":20.164594123951}},"BIJNOR":{"1":{"mandays":"54220","per":140.75073983698},"2":{"mandays":"77043","per":36.518289243545}},"BUDAUN":{"1":{"mandays":"37318","per":54.323395830907},"2":{"mandays":"43917","per":20.987011249271}},"BULANDSHAHR":{"1":{"mandays":"6077","per":40.322473624842},"2":{"mandays":"10887","per":18.835640138408}},"CHANDAULI":{"1":{"mandays":"29279","per":161.42353070901},"2":{"mandays":"45747","per":27.733858745074}},"CHITRAKOOT":{"1":{"mandays":"69975","per":61.288034053287},"2":{"mandays":"80301","per":37.943515425288}},"DEORIA":{"1":{"mandays":"47750","per":56.851329309093},"2":{"mandays":"53063","per":17.281662801907}},"ETAH":{"1":{"mandays":"12571","per":31.769016932019},"2":{"mandays":"21513","per":16.183462221286}},"ETAWAH":{"1":{"mandays":"10070","per":23.780286213574},"2":{"mandays":"12493","per":10.572951929587}},"FAIZABAD":{"1":{"mandays":"62112","per":37.611723386218},"2":{"mandays":"98054","per":27.665187300208}},"FARRUKHABAD":{"1":{"mandays":"6653","per":18.10389398351},"2":{"mandays":"9914","per":7.5425476069111}},"FATEHPUR":{"1":{"mandays":"21075","per":22.667871317479},"2":{"mandays":"25380","per":9.7099636163302}},"FIROZABAD":{"1":{"mandays":"26745","per":121.60134582159},"2":{"mandays":"39711","per":43.370612262729}},"GAUTAM BUDDHA NAGAR":{"1":{"mandays":"0","per":0},"2":{"mandays":"0","per":0}},"GHAZIABAD":{"1":{"mandays":"0","per":0},"2":{"mandays":"0","per":0}},"GHAZIPUR":{"1":{"mandays":"1436","per":1.4412172062868},"2":{"mandays":"5524","per":1.3694656753494}},"GONDA":{"1":{"mandays":"52250","per":22.601533876347},"2":{"mandays":"57536","per":10.975586492642}},"GORAKHPUR":{"1":{"mandays":"33652","per":15.445979005733},"2":{"mandays":"64982","per":9.7645637487077}},"HAMIRPUR":{"1":{"mandays":"36606","per":75.141637244437},"2":{"mandays":"64764","per":52.345120226308}},"HAPUR":{"1":{"mandays":"1201","per":188.24451410658},"2":{"mandays":"1201","per":20.400883302191}},"HARDOI":{"1":{"mandays":"75570","per":27.586131370874},"2":{"mandays":"106806","per":15.875606449772}},"HATHRAS":{"1":{"mandays":"7490","per":70.487483530962},"2":{"mandays":"12622","per":24.654269864833}},"JALAUN":{"1":{"mandays":"24580","per":40.416995527493},"2":{"mandays":"32894","per":13.920086667287}},"JAUNPUR":{"1":{"mandays":"161702","per":93.988200761429},"2":{"mandays":"199160","per":42.150532172691}},"JHANSI":{"1":{"mandays":"141360","per":90.581126368873},"2":{"mandays":"193279","per":52.207512972262}},"KANNAUJ":{"1":{"mandays":"33341","per":97.591031495141},"2":{"mandays":"47098","per":33.197296173338}},"KANPUR DEHAT":{"1":{"mandays":"17218","per":23.537292213473},"2":{"mandays":"22139","per":13.55094995593}},"KANPUR NAGAR":{"1":{"mandays":"58491","per":106.82702317681},"2":{"mandays":"70764","per":55.14178179863}},"KASHGANJ":{"1":{"mandays":"8083","per":15.677489429381},"2":{"mandays":"11970","per":8.8087896561113}},"KAUSHAMBI":{"1":{"mandays":"9547","per":12.323639133073},"2":{"mandays":"11360","per":5.8217300172704}},"KHERI":{"1":{"mandays":"43719","per":42.429565504324},"2":{"mandays":"65083","per":17.375529611525}},"KUSHI NAGAR":{"1":{"mandays":"12651","per":8.0539091794575},"2":{"mandays":"30399","per":4.706980806035}},"LALITPUR":{"1":{"mandays":"126793","per":97.590880752446},"2":{"mandays":"166209","per":50.231803290579}},"LUCKNOW":{"1":{"mandays":"29303","per":97.390986439777},"2":{"mandays":"36274","per":25.798330085487}},"MAHARAJGANJ":{"1":{"mandays":"18279","per":11.71685704396},"2":{"mandays":"26200","per":3.6533398777386}},"MAHOBA":{"1":{"mandays":"13995","per":77.328986628357},"2":{"mandays":"23668","per":29.451730917598}},"MAINPURI":{"1":{"mandays":"7258","per":26.585106772646},"2":{"mandays":"13288","per":13.387199145669}},"MATHURA":{"1":{"mandays":"7504","per":25.061786119832},"2":{"mandays":"8086","per":9.4036377168907}},"MAU":{"1":{"mandays":"28913","per":22.290322331953},"2":{"mandays":"36513","per":11.48286988408}},"MEERUT":{"1":{"mandays":"1435","per":21.034887129874},"2":{"mandays":"5938","per":20.056067821799}},"MIRZAPUR":{"1":{"mandays":"31704","per":36.236041740482},"2":{"mandays":"43374","per":19.005678830582}},"MORADABAD":{"1":{"mandays":"27896","per":41.219321187405},"2":{"mandays":"40083","per":19.773373061289}},"MUZAFFARNAGAR":{"1":{"mandays":"5873","per":64.080741953082},"2":{"mandays":"7973","per":22.087708119788}},"PILIBHIT":{"1":{"mandays":"7881","per":8.1797235023041},"2":{"mandays":"10705","per":4.5599761458511}},"PRATAPGARH":{"1":{"mandays":"82066","per":78.777057835373},"2":{"mandays":"103023","per":40.381065116589}},"RAE BARELI":{"1":{"mandays":"72819","per":50.359617698723},"2":{"mandays":"106534","per":27.624530014262}},"RAMPUR":{"1":{"mandays":"1252","per":2.515420006831},"2":{"mandays":"8758","per":5.3483969465649}},"SAHARANPUR":{"1":{"mandays":"5818","per":38.911182450508},"2":{"mandays":"9401","per":15.3902822343}},"SAMBHAL":{"1":{"mandays":"28367","per":53.5135543021},"2":{"mandays":"46868","per":26.094024898114}},"SANT KABEER NAGAR":{"1":{"mandays":"42647","per":35.67473064311},"2":{"mandays":"62718","per":18.513500349796}},"SANT RAVIDAS NAGAR":{"1":{"mandays":"24136","per":50.655865007241},"2":{"mandays":"27584","per":26.6188022311}},"SHAHJAHANPUR":{"1":{"mandays":"68755","per":80.223793521889},"2":{"mandays":"94889","per":32.750271800093}},"SHAMLI":{"1":{"mandays":"2873","per":33.764249618051},"2":{"mandays":"3979","per":16.895248609401}},"SHRAVASTI":{"1":{"mandays":"21317","per":33.291166916542},"2":{"mandays":"24694","per":15.912312807691}},"SIDDHARTH NAGAR":{"1":{"mandays":"234680","per":71.40748944923},"2":{"mandays":"384203","per":40.470537426001}},"SITAPUR":{"1":{"mandays":"228247","per":101.89962141505},"2":{"mandays":"298512","per":45.850715457444}},"SONBHADRA":{"1":{"mandays":"88791","per":50.733075833067},"2":{"mandays":"106023","per":28.670362358031}},"SULTANPUR":{"1":{"mandays":"72137","per":49.379479351345},"2":{"mandays":"77214","per":28.740736329223}},"UNNAO":{"1":{"mandays":"55704","per":39.400755421636},"2":{"mandays":"90567","per":21.163480861803}},"VARANASI":{"1":{"mandays":"23335","per":57.860153731713},"2":{"mandays":"39753","per":27.127006223387}},"Total":{"1":{"mandays":"3370590","per":49.795519542281},"2":{"mandays":"4754075","per":23.912583131885}}}	1432248193	\r\n\r\n<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">\r\n\r\n\r\n<html xmlns="http://www.w3.org/1999/xhtml">\r\n<head><title>\r\n\tMahatma Gandhi National Rural Employment Guarantee Act (MGNREGA)\r\n</title><link rel="shortcut icon" href="images/title_logo.jpg" />\r\n  <style type="text/css" media="all">\r\n @import url( http://nrega.nic.in/hp.css );\r\n</style>\r\n</head>\r\n<body topmargin="0" leftmargin="0" rightmargin="0" bgcolor="Floralwhite">\r\n  <form name="aspnetForm" method="post" action="projected_VS_generated.aspx?file1=empprov&amp;page1=s&amp;lflag=eng&amp;state_name=UTTAR+PRADESH&amp;state_code=31&amp;fin_year=2015-2016&amp;Digest=CgyzEo8dpRYpwcFbitdqJg" id="aspnetForm">\r\n<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="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" />\r\n\r\n<input type="hidden" name="__VIEWSTATEENCRYPTED" id="__VIEWSTATEENCRYPTED" value="" />\r\n<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="o6m2g2bwM9WRmZnGGYHIP70xS7WKy4ayDF8IJrBbu0COVVEruHdgTUljb++TXzDOlSCUS6EaEnxsculnyJsSziQla5lmoyZ1RvMYy7vBKmFT0PEcmxaj2Y0wM8N+ca+l/adIGA==" />\r\n    <div>\r\n        \r\n         <table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor='#ffe7b7'>\r\n            <tr>\r\n                <td width='17%' bgcolor='#ffffd5'>\r\n                    <font size="6" color="#bd1725" face="verdana"><b></b></font>\r\n                </td>\r\n                <td width="83%" align="right">\r\n                    <b><font face="Arial" color="Black" size="2">Govt. of India<br />\r\n                        Ministry of Rural Development<br />\r\n                        Department of Rural Development</font></b>\r\n                </td>\r\n            </tr>\r\n            </table>\r\n            <table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor='#FFBB55'>\r\n            <tr>\r\n                <td width="50%" bgcolor="#ffffd5" height="21" align="left">\r\n                    <font face="Arial" size="2" color="#bd1725"><b>\r\n                       The Mahatma Gandhi National Rural Employment Guarantee Act </b></font>\r\n                </td>\r\n                <td width="50%" bgcolor="#ffffd5" height="21" align="right">\r\n                    <font face="Arial" size="2" color="#bd1725">\r\n                        22-May-2015 04:13:23 AM&nbsp;</font>\r\n                </td>\r\n            </tr>\r\n        </table>\r\n        \r\n         \r\n\r\n<table id="Table1" style="border-collapse:collapse; height: 18px; width: 99%;" \r\n        cellpadding="1" cellspacing="1" border="0" bordercolor="black">\r\n  <tr valign="top">\r\n          <td width="7%" bgcolor="silver" align="right">\r\n            <b><a id="ctl00_ContentPlaceHolder1_back" href="javascript:history.go(-1);">Back</a>&nbsp;&nbsp;\r\n               </b> \r\n          </td>  </tr></table>\r\n\r\n<center>\r\n<b><span id="ctl00_ContentPlaceHolder1_lb_zp"> Projected Persondays and Persondays Generated for Fin :2015-2016</span></b>\r\n <br /> <b><span id="ctl00_ContentPlaceHolder1_lbl_head"><b>State :</b> UTTAR PRADESH</span> </b>\r\n<br/>\r\n<span id="ctl00_ContentPlaceHolder1_RadioButtonList1"><input id="ctl00_ContentPlaceHolder1_RadioButtonList1_0" type="radio" name="ctl00$ContentPlaceHolder1$RadioButtonList1" value="0" checked="checked" /><label for="ctl00_ContentPlaceHolder1_RadioButtonList1_0">All Blocks</label><input id="ctl00_ContentPlaceHolder1_RadioButtonList1_1" type="radio" name="ctl00$ContentPlaceHolder1$RadioButtonList1" value="1" onclick="javascript:setTimeout('__doPostBack(\\'ctl00$ContentPlaceHolder1$RadioButtonList1$1\\',\\'\\')', 0)" /><label for="ctl00_ContentPlaceHolder1_RadioButtonList1_1">IPPE Blocks</label><input id="ctl00_ContentPlaceHolder1_RadioButtonList1_2" type="radio" name="ctl00$ContentPlaceHolder1$RadioButtonList1" value="2" onclick="javascript:setTimeout('__doPostBack(\\'ctl00$ContentPlaceHolder1$RadioButtonList1$2\\',\\'\\')', 0)" /><label for="ctl00_ContentPlaceHolder1_RadioButtonList1_2">Non IPPE Blocks</label></span>\r\n\r\n<table  id="t1" align="center" width="99%" border="1" bordercolor="#EBEBEB" style="border-collapse:collapse " cellspacing="0" >\r\n  <tr bgcolor="#82b4ff">\r\n                                        <td align="center" rowspan="3"><b>S.No</b></td>\r\n                                        \r\n                                        <td align="center" rowspan="3"><b>Districts</b></td>\r\n                                        \r\n        \r\n            \r\n           <td colspan="24" align="center"><b>Projected Persondays and Persondays Generated </td> \r\n     \r\n                                    \r\n  </tr>   \r\n <tr bgcolor="#82b4ff">\r\n   <td colspan="2" align="center" ><b>Upto April</b></td>\r\n   <td colspan="2" align="center"><b>Upto May</b></td>\r\n   <td colspan="2" align="center"><b>Upto June</b></td>\r\n   <td colspan="2" align="center"><b>Upto July</b></td>\r\n   <td colspan="2" align="center"><b>Upto August</b></td>\r\n   <td colspan="2" align="center"><b>Upto September</b></td>\r\n   <td colspan="2" align="center"><b>Upto October</b></td>\r\n   <td colspan="2" align="center"><b>Upto November</b></td>\r\n   <td colspan="2" align="center"><b>Upto December</b></td>\r\n   \r\n   <td colspan="2" align="center"><b>Upto January</b></td>\r\n   <td colspan="2" align="center"><b>Upto February</b></td>\r\n   <td colspan="2" align="center"><b>Upto March</b></td>\r\n  \r\n     \r\n     </tr>\r\n   \r\n  \r\n  <tr bgcolor="#82b4ff">\r\n  \r\n<td><b>Projected Persondays</b></td>\r\n<td><b>Persondays Generated</b></td>\r\n              \r\n<td><b>Projected Persondays</b></td>\r\n<td><b>Persondays Generated</b></td>\r\n              \r\n<td colspan="2"><b>Projected Persondays</b></td>\r\n\r\n              \r\n<td colspan="2"><b>Projected Persondays</b></td>\r\n\r\n              \r\n<td colspan="2"><b>Projected Persondays</b></td>\r\n\r\n              \r\n<td colspan="2"><b>Projected Persondays</b></td>\r\n\r\n              \r\n<td colspan="2"><b>Projected Persondays</b></td>\r\n\r\n              \r\n<td colspan="2"><b>Projected Persondays</b></td>\r\n\r\n              \r\n<td colspan="2"><b>Projected Persondays</b></td>\r\n\r\n              \r\n<td colspan="2"><b>Projected Persondays</b></td>\r\n\r\n              \r\n<td colspan="2"><b>Projected Persondays</b></td>\r\n\r\n              \r\n<td colspan="2"><b>Projected Persondays</b></td>\r\n\r\n              \r\n   </tr>\r\n   <tr bgcolor="#82b4ff">\r\n                 \r\n                <td align="center"><b>1</b></td>\r\n                 \r\n                <td align="center"><b>2</b></td>\r\n                 \r\n                <td align="center"><b>3</b></td>\r\n                 \r\n                <td align="center"><b>4</b></td>\r\n                 \r\n                <td align="center"><b>5</b></td>\r\n                 \r\n                <td align="center"><b>6</b></td>\r\n                 \r\n                <td align="center"><b>7</b></td>\r\n                 \r\n                <td align="center"><b>8</b></td>\r\n                 \r\n                <td align="center"><b>9</b></td>\r\n                 \r\n                <td align="center"><b>10</b></td>\r\n                 \r\n                <td align="center"><b>11</b></td>\r\n                 \r\n                <td align="center"><b>12</b></td>\r\n                 \r\n                <td align="center"><b>13</b></td>\r\n                 \r\n                <td align="center"><b>14</b></td>\r\n                 \r\n                <td align="center"><b>15</b></td>\r\n                 \r\n                <td align="center"><b>16</b></td>\r\n                 \r\n                <td align="center"><b>17</b></td>\r\n                 \r\n                <td align="center"><b>18</b></td>\r\n                 \r\n                <td align="center"><b>19</b></td>\r\n                 \r\n                <td align="center"><b>20</b></td>\r\n                 \r\n                <td align="center"><b>21</b></td>\r\n                 \r\n                <td align="center"><b>22</b></td>\r\n                 \r\n                <td align="center"><b>23</b></td>\r\n                 \r\n                <td align="center"><b>24</b></td>\r\n                 \r\n                <td align="center"><b>25</b></td>\r\n                 \r\n                <td align="center"><b>26</b></td>\r\n                 \r\n                 </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl01_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl01_Label1">1</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl01_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl01_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AGRA&district_code=3120&fin_year=2015-2016&Digest=tRM0SoS+7mCALrRloE5saw'>AGRA</a></span></font></td>\r\n\r\n    \r\n   <td align="right">50618</td>\r\n   <td align="right"><font color="green">36410</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">150743</td>\r\n    <td align="right"><font color="green">65679</font></td>\r\n        \r\n <td align="right" colspan="2">298586</td>\r\n   \r\n        \r\n <td align="right" colspan="2">430578</td>\r\n   \r\n        \r\n <td align="right" colspan="2">521587</td>\r\n   \r\n        \r\n <td align="right" colspan="2">630725</td>\r\n   \r\n        \r\n <td align="right" colspan="2">741260</td>\r\n   \r\n        \r\n <td align="right" colspan="2">817927</td>\r\n   \r\n        \r\n <td align="right" colspan="2">894167</td>\r\n   \r\n        \r\n <td align="right" colspan="2">953131</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1001653</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1051190</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl02_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl02_Label1">2</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl02_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl02_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=ALIGARH&district_code=3118&fin_year=2015-2016&Digest=GXjVN5hve8A0WHOkCDOcig'>ALIGARH</a></span></font></td>\r\n\r\n    \r\n   <td align="right">46224</td>\r\n   <td align="right"><font color="green">8592</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">194588</td>\r\n    <td align="right"><font color="green">13913</font></td>\r\n        \r\n <td align="right" colspan="2">437081</td>\r\n   \r\n        \r\n <td align="right" colspan="2">634822</td>\r\n   \r\n        \r\n <td align="right" colspan="2">804271</td>\r\n   \r\n        \r\n <td align="right" colspan="2">965371</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1140222</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1297895</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1527750</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1715424</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1806732</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1999413</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl03_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl03_Label1">3</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl03_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl03_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=ALLAHABAD&district_code=3145&fin_year=2015-2016&Digest=WGDHEw0EZqr+hfoQRd7hcg'>ALLAHABAD</a></span></font></td>\r\n\r\n    \r\n   <td align="right">173466</td>\r\n   <td align="right"><font color="green">104544</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">407611</td>\r\n    <td align="right"><font color="green">120864</font></td>\r\n        \r\n <td align="right" colspan="2">817206</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1101094</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1326777</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1544904</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1753024</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1997089</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2303881</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2584166</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2830419</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3036150</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl04_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl04_Label1">4</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl04_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl04_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AMBEDKAR+NAGAR&district_code=3178&fin_year=2015-2016&Digest=6xCDtXIon9+woChHWRt+/Q'>AMBEDKAR NAGAR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">118238</td>\r\n   <td align="right"><font color="green">115630</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">287622</td>\r\n    <td align="right"><font color="green">143816</font></td>\r\n        \r\n <td align="right" colspan="2">563538</td>\r\n   \r\n        \r\n <td align="right" colspan="2">772853</td>\r\n   \r\n        \r\n <td align="right" colspan="2">899529</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1008866</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1104270</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1255759</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1466699</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1597168</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1726673</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1922920</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl05_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl05_Label1">5</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl05_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl05_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AMETHI&district_code=3181&fin_year=2015-2016&Digest=ZuycpaUonoDQBJ7iNfp/Rg'>AMETHI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">116584</td>\r\n   <td align="right"><font color="green">87862</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">305352</td>\r\n    <td align="right"><font color="green">152171</font></td>\r\n        \r\n <td align="right" colspan="2">578581</td>\r\n   \r\n        \r\n <td align="right" colspan="2">786834</td>\r\n   \r\n        \r\n <td align="right" colspan="2">933344</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1081344</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1234198</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1385710</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1650814</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1914766</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2140360</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2296739</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl06_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl06_Label1">6</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl06_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl06_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AMROHA&district_code=3167&fin_year=2015-2016&Digest=iI+wtGgnbUaceHymdPOsfQ'>AMROHA</a></span></font></td>\r\n\r\n    \r\n   <td align="right">24774</td>\r\n   <td align="right"><font color="green">73618</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">158159</td>\r\n    <td align="right"><font color="green">138766</font></td>\r\n        \r\n <td align="right" colspan="2">436071</td>\r\n   \r\n        \r\n <td align="right" colspan="2">660234</td>\r\n   \r\n        \r\n <td align="right" colspan="2">829272</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1023720</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1188215</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1338054</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1519615</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1706670</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1860858</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2031899</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl07_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl07_Label1">7</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl07_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl07_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AURAIYA&district_code=3169&fin_year=2015-2016&Digest=t5CDGH1EsNMxDO78ppMdHg'>AURAIYA</a></span></font></td>\r\n\r\n    \r\n   <td align="right">38970</td>\r\n   <td align="right"><font color="green">19206</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">163560</td>\r\n    <td align="right"><font color="green">29132</font></td>\r\n        \r\n <td align="right" colspan="2">360394</td>\r\n   \r\n        \r\n <td align="right" colspan="2">498342</td>\r\n   \r\n        \r\n <td align="right" colspan="2">554848</td>\r\n   \r\n        \r\n <td align="right" colspan="2">645183</td>\r\n   \r\n        \r\n <td align="right" colspan="2">786147</td>\r\n   \r\n        \r\n <td align="right" colspan="2">918755</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1109333</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1228069</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1290018</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1370686</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl08_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl08_Label1">8</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl08_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl08_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AZAMGARH&district_code=3157&fin_year=2015-2016&Digest=cCKbpgnS6n7Kl2UatV/4mQ'>AZAMGARH</a></span></font></td>\r\n\r\n    \r\n   <td align="right">178233</td>\r\n   <td align="right"><font color="green">132177</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">555785</td>\r\n    <td align="right"><font color="green">184543</font></td>\r\n        \r\n <td align="right" colspan="2">1320050</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1804809</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2062652</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2268838</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2467570</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2681381</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2964992</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3192206</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3451050</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3795583</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl09_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl09_Label1">9</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl09_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl09_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BAGHPAT&district_code=3165&fin_year=2015-2016&Digest=LwvxUa8qfQ2DBZQhMV7gcQ'>BAGHPAT</a></span></font></td>\r\n\r\n    \r\n   <td align="right">4236</td>\r\n   <td align="right"><font color="green">1650</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">15965</td>\r\n    <td align="right"><font color="green">1950</font></td>\r\n        \r\n <td align="right" colspan="2">36385</td>\r\n   \r\n        \r\n <td align="right" colspan="2">54271</td>\r\n   \r\n        \r\n <td align="right" colspan="2">70210</td>\r\n   \r\n        \r\n <td align="right" colspan="2">86454</td>\r\n   \r\n        \r\n <td align="right" colspan="2">103776</td>\r\n   \r\n        \r\n <td align="right" colspan="2">116706</td>\r\n   \r\n        \r\n <td align="right" colspan="2">129748</td>\r\n   \r\n        \r\n <td align="right" colspan="2">140390</td>\r\n   \r\n        \r\n <td align="right" colspan="2">150962</td>\r\n   \r\n        \r\n <td align="right" colspan="2">171314</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl10_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl10_Label1">10</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl10_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl10_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BAHRAICH&district_code=3146&fin_year=2015-2016&Digest=8BLtdj5LDp+Bk24mQcZrVA'>BAHRAICH</a></span></font></td>\r\n\r\n    \r\n   <td align="right">214317</td>\r\n   <td align="right"><font color="green">61515</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">605053</td>\r\n    <td align="right"><font color="green">85219</font></td>\r\n        \r\n <td align="right" colspan="2">1367690</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1787593</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2019125</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2280917</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2590901</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2945000</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3542753</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3946082</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4210614</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4587192</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl11_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl11_Label1">11</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl11_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl11_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BALLIA&district_code=3159&fin_year=2015-2016&Digest=OMyuEI+dqcimT6Kfclq1JQ'>BALLIA</a></span></font></td>\r\n\r\n    \r\n   <td align="right">59360</td>\r\n   <td align="right"><font color="green">14977</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">253668</td>\r\n    <td align="right"><font color="green">25430</font></td>\r\n        \r\n <td align="right" colspan="2">627475</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1000023</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1211532</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1339551</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1445424</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1593006</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1808110</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1955910</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2069383</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2236434</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl12_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl12_Label1">12</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl12_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl12_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BALRAMPUR&district_code=3175&fin_year=2015-2016&Digest=EDPasx4UtQ7/Yx+YEei3QQ'>BALRAMPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">123359</td>\r\n   <td align="right"><font color="green">10130</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">316584</td>\r\n    <td align="right"><font color="green">16205</font></td>\r\n        \r\n <td align="right" colspan="2">766412</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1056226</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1183734</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1339886</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1586840</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1894033</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2364407</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2790713</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3056583</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3368738</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl13_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl13_Label1">13</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl13_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl13_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BANDA&district_code=3142&fin_year=2015-2016&Digest=q42oZGdw/pHE9OSCnklbPg'>BANDA</a></span></font></td>\r\n\r\n    \r\n   <td align="right">162076</td>\r\n   <td align="right"><font color="green">91199</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">341822</td>\r\n    <td align="right"><font color="green">113321</font></td>\r\n        \r\n <td align="right" colspan="2">586248</td>\r\n   \r\n        \r\n <td align="right" colspan="2">811410</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1025570</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1326384</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1654720</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1939053</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2211816</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2453423</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2680346</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2965543</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl14_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl14_Label1">14</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl14_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl14_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BARABANKI&district_code=3148&fin_year=2015-2016&Digest=eqwk8kXjGe41V7LVDuZ1jQ'>BARABANKI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">150643</td>\r\n   <td align="right"><font color="green">58217</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">410954</td>\r\n    <td align="right"><font color="green">63687</font></td>\r\n        \r\n <td align="right" colspan="2">904280</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1420949</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1810936</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2095689</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2407034</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2778626</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3346339</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3731561</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4032948</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4312243</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl15_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl15_Label1">15</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl15_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl15_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BAREILLY&district_code=3125&fin_year=2015-2016&Digest=HAGu+GqSWr+jgO7FWrY4Lg'>BAREILLY</a></span></font></td>\r\n\r\n    \r\n   <td align="right">44217</td>\r\n   <td align="right"><font color="green">27467</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">148154</td>\r\n    <td align="right"><font color="green">36230</font></td>\r\n        \r\n <td align="right" colspan="2">321281</td>\r\n   \r\n        \r\n <td align="right" colspan="2">476287</td>\r\n   \r\n        \r\n <td align="right" colspan="2">589263</td>\r\n   \r\n        \r\n <td align="right" colspan="2">731384</td>\r\n   \r\n        \r\n <td align="right" colspan="2">855111</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1023425</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1294966</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1500340</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1611302</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1735298</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl16_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl16_Label1">16</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl16_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl16_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BASTI&district_code=3153&fin_year=2015-2016&Digest=kQJXXKeRQaxM2vf9zup1PA'>BASTI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">162628</td>\r\n   <td align="right"><font color="green">64876</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">716672</td>\r\n    <td align="right"><font color="green">144514</font></td>\r\n        \r\n <td align="right" colspan="2">1590816</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1905250</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2090278</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2258248</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2453691</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2734873</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3198162</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3548346</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3880546</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4204491</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl17_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl17_Label1">17</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl17_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl17_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BIJNOR&district_code=3109&fin_year=2015-2016&Digest=+QrsBzXTft4PeQ2X3gCyzg'>BIJNOR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">38522</td>\r\n   <td align="right"><font color="green">54220</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">210971</td>\r\n    <td align="right"><font color="green">77043</font></td>\r\n        \r\n <td align="right" colspan="2">574432</td>\r\n   \r\n        \r\n <td align="right" colspan="2">752336</td>\r\n   \r\n        \r\n <td align="right" colspan="2">809208</td>\r\n   \r\n        \r\n <td align="right" colspan="2">903823</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1002145</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1103675</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1252182</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1368376</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1510431</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1668322</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl18_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl18_Label1">18</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl18_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl18_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BUDAUN&district_code=3124&fin_year=2015-2016&Digest=nSyjuvg1Oj5BbE/ZF372bg'>BUDAUN</a></span></font></td>\r\n\r\n    \r\n   <td align="right">68696</td>\r\n   <td align="right"><font color="green">37318</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">209258</td>\r\n    <td align="right"><font color="green">43917</font></td>\r\n        \r\n <td align="right" colspan="2">471648</td>\r\n   \r\n        \r\n <td align="right" colspan="2">799743</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1072254</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1380769</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1589687</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1717312</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1924880</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2118737</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2250755</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2372775</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl19_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl19_Label1">19</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl19_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl19_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BULANDSHAHR&district_code=3117&fin_year=2015-2016&Digest=WShNy3QeuaRqaYJMghSlOg'>BULANDSHAHR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">15071</td>\r\n   <td align="right"><font color="green">6077</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">57800</td>\r\n    <td align="right"><font color="green">10887</font></td>\r\n        \r\n <td align="right" colspan="2">135545</td>\r\n   \r\n        \r\n <td align="right" colspan="2">213592</td>\r\n   \r\n        \r\n <td align="right" colspan="2">262042</td>\r\n   \r\n        \r\n <td align="right" colspan="2">312546</td>\r\n   \r\n        \r\n <td align="right" colspan="2">362237</td>\r\n   \r\n        \r\n <td align="right" colspan="2">418207</td>\r\n   \r\n        \r\n <td align="right" colspan="2">481320</td>\r\n   \r\n        \r\n <td align="right" colspan="2">528243</td>\r\n   \r\n        \r\n <td align="right" colspan="2">593437</td>\r\n   \r\n        \r\n <td align="right" colspan="2">647737</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl20_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl20_Label1">20</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl20_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl20_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=CHANDAULI&district_code=3171&fin_year=2015-2016&Digest=9taP8s6SuYwQDCeN0ZR6SA'>CHANDAULI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">18138</td>\r\n   <td align="right"><font color="green">29279</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">164950</td>\r\n    <td align="right"><font color="green">45747</font></td>\r\n        \r\n <td align="right" colspan="2">446046</td>\r\n   \r\n        \r\n <td align="right" colspan="2">698087</td>\r\n   \r\n        \r\n <td align="right" colspan="2">843980</td>\r\n   \r\n        \r\n <td align="right" colspan="2">943510</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1049484</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1172224</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1372917</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1567311</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1682124</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1821664</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl21_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl21_Label1">21</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl21_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl21_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=CHITRAKOOT&district_code=3177&fin_year=2015-2016&Digest=QINqS+CgjKiV7hZa9kx2Eg'>CHITRAKOOT</a></span></font></td>\r\n\r\n    \r\n   <td align="right">114174</td>\r\n   <td align="right"><font color="green">69975</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">211633</td>\r\n    <td align="right"><font color="green">80301</font></td>\r\n        \r\n <td align="right" colspan="2">396219</td>\r\n   \r\n        \r\n <td align="right" colspan="2">579276</td>\r\n   \r\n        \r\n <td align="right" colspan="2">793360</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1031105</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1257940</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1460643</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1681680</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1877642</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2093646</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2307979</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl22_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl22_Label1">22</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl22_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl22_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=DEORIA&district_code=3155&fin_year=2015-2016&Digest=FOj+W+IkpVE7Ri/A2M4hsg'>DEORIA</a></span></font></td>\r\n\r\n    \r\n   <td align="right">83991</td>\r\n   <td align="right"><font color="green">47750</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">307048</td>\r\n    <td align="right"><font color="green">53063</font></td>\r\n        \r\n <td align="right" colspan="2">683054</td>\r\n   \r\n        \r\n <td align="right" colspan="2">935234</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1068235</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1174973</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1297466</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1474393</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1783314</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2006621</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2161742</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2343294</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl23_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl23_Label1">23</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl23_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl23_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=ETAH&district_code=3122&fin_year=2015-2016&Digest=1H5CeZE8ykxBX/CYN3vrRw'>ETAH</a></span></font></td>\r\n\r\n    \r\n   <td align="right">39570</td>\r\n   <td align="right"><font color="green">12571</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">132932</td>\r\n    <td align="right"><font color="green">21513</font></td>\r\n        \r\n <td align="right" colspan="2">301707</td>\r\n   \r\n        \r\n <td align="right" colspan="2">480878</td>\r\n   \r\n        \r\n <td align="right" colspan="2">619648</td>\r\n   \r\n        \r\n <td align="right" colspan="2">802024</td>\r\n   \r\n        \r\n <td align="right" colspan="2">949904</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1068706</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1202671</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1292152</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1345915</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1424407</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl24_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl24_Label1">24</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl24_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl24_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=ETAWAH&district_code=3135&fin_year=2015-2016&Digest=vnOLmMAKrTqJAJ+9rqYifQ'>ETAWAH</a></span></font></td>\r\n\r\n    \r\n   <td align="right">42346</td>\r\n   <td align="right"><font color="green">10070</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">118160</td>\r\n    <td align="right"><font color="green">12493</font></td>\r\n        \r\n <td align="right" colspan="2">288084</td>\r\n   \r\n        \r\n <td align="right" colspan="2">422467</td>\r\n   \r\n        \r\n <td align="right" colspan="2">524203</td>\r\n   \r\n        \r\n <td align="right" colspan="2">610365</td>\r\n   \r\n        \r\n <td align="right" colspan="2">713028</td>\r\n   \r\n        \r\n <td align="right" colspan="2">811115</td>\r\n   \r\n        \r\n <td align="right" colspan="2">957609</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1066193</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1154732</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1240112</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl25_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl25_Label1">25</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl25_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl25_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=FAIZABAD&district_code=3149&fin_year=2015-2016&Digest=BkB7wLUvbfEEV1/lMhxzIA'>FAIZABAD</a></span></font></td>\r\n\r\n    \r\n   <td align="right">165140</td>\r\n   <td align="right"><font color="green">62112</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">354431</td>\r\n    <td align="right"><font color="green">98054</font></td>\r\n        \r\n <td align="right" colspan="2">685659</td>\r\n   \r\n        \r\n <td align="right" colspan="2">977920</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1217719</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1431566</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1657073</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1911100</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2302062</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2616232</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2811104</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2985911</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl26_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl26_Label1">26</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl26_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl26_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=FARRUKHABAD&district_code=3134&fin_year=2015-2016&Digest=4QAPUTdeSuSWtFLNVDlfqg'>FARRUKHABAD</a></span></font></td>\r\n\r\n    \r\n   <td align="right">36749</td>\r\n   <td align="right"><font color="green">6653</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">131441</td>\r\n    <td align="right"><font color="green">9914</font></td>\r\n        \r\n <td align="right" colspan="2">290003</td>\r\n   \r\n        \r\n <td align="right" colspan="2">425629</td>\r\n   \r\n        \r\n <td align="right" colspan="2">533474</td>\r\n   \r\n        \r\n <td align="right" colspan="2">652528</td>\r\n   \r\n        \r\n <td align="right" colspan="2">788417</td>\r\n   \r\n        \r\n <td align="right" colspan="2">889194</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1010602</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1134724</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1244832</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1366804</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl27_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl27_Label1">27</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl27_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl27_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=FATEHPUR&district_code=3143&fin_year=2015-2016&Digest=X1xqxyJzNafRf2R56ePTAg'>FATEHPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">92973</td>\r\n   <td align="right"><font color="green">21075</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">261381</td>\r\n    <td align="right"><font color="green">25380</font></td>\r\n        \r\n <td align="right" colspan="2">570289</td>\r\n   \r\n        \r\n <td align="right" colspan="2">838964</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1087037</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1394654</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1629658</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1827298</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2224062</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2476440</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2650741</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2805475</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl28_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl28_Label1">28</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl28_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl28_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=FIROZABAD&district_code=3121&fin_year=2015-2016&Digest=SlMefVavEAp3wQPCwi9Zsg'>FIROZABAD</a></span></font></td>\r\n\r\n    \r\n   <td align="right">21994</td>\r\n   <td align="right"><font color="green">26745</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">91562</td>\r\n    <td align="right"><font color="green">39711</font></td>\r\n        \r\n <td align="right" colspan="2">231258</td>\r\n   \r\n        \r\n <td align="right" colspan="2">363604</td>\r\n   \r\n        \r\n <td align="right" colspan="2">430898</td>\r\n   \r\n        \r\n <td align="right" colspan="2">526447</td>\r\n   \r\n        \r\n <td align="right" colspan="2">626333</td>\r\n   \r\n        \r\n <td align="right" colspan="2">706664</td>\r\n   \r\n        \r\n <td align="right" colspan="2">809245</td>\r\n   \r\n        \r\n <td align="right" colspan="2">884065</td>\r\n   \r\n        \r\n <td align="right" colspan="2">912699</td>\r\n   \r\n        \r\n <td align="right" colspan="2">958645</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl29_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl29_Label1">29</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl29_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl29_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GAUTAM+BUDDHA+NAGAR&district_code=3164&fin_year=2015-2016&Digest=EsPdUY7/8NuWxmAvaMCNEQ'>GAUTAM BUDDHA NAGAR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">3145</td>\r\n   <td align="right"><font color="green">0</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">4277</td>\r\n    <td align="right"><font color="green">0</font></td>\r\n        \r\n <td align="right" colspan="2">5758</td>\r\n   \r\n        \r\n <td align="right" colspan="2">10351</td>\r\n   \r\n        \r\n <td align="right" colspan="2">17459</td>\r\n   \r\n        \r\n <td align="right" colspan="2">24314</td>\r\n   \r\n        \r\n <td align="right" colspan="2">31110</td>\r\n   \r\n        \r\n <td align="right" colspan="2">37062</td>\r\n   \r\n        \r\n <td align="right" colspan="2">41426</td>\r\n   \r\n        \r\n <td align="right" colspan="2">45223</td>\r\n   \r\n        \r\n <td align="right" colspan="2">47197</td>\r\n   \r\n        \r\n <td align="right" colspan="2">55195</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl30_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl30_Label1">30</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl30_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl30_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GHAZIABAD&district_code=3116&fin_year=2015-2016&Digest=L5HEoHozqXkaxAah2abefQ'>GHAZIABAD</a></span></font></td>\r\n\r\n    \r\n   <td align="right">1699</td>\r\n   <td align="right"><font color="green">0</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">9218</td>\r\n    <td align="right"><font color="green">0</font></td>\r\n        \r\n <td align="right" colspan="2">13269</td>\r\n   \r\n        \r\n <td align="right" colspan="2">19066</td>\r\n   \r\n        \r\n <td align="right" colspan="2">24665</td>\r\n   \r\n        \r\n <td align="right" colspan="2">29099</td>\r\n   \r\n        \r\n <td align="right" colspan="2">34805</td>\r\n   \r\n        \r\n <td align="right" colspan="2">40274</td>\r\n   \r\n        \r\n <td align="right" colspan="2">45965</td>\r\n   \r\n        \r\n <td align="right" colspan="2">49091</td>\r\n   \r\n        \r\n <td align="right" colspan="2">52604</td>\r\n   \r\n        \r\n <td align="right" colspan="2">62538</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl31_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl31_Label1">31</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl31_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl31_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GHAZIPUR&district_code=3160&fin_year=2015-2016&Digest=P5v7DnUXAJnaajvr6eWE4A'>GHAZIPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">99638</td>\r\n   <td align="right"><font color="green">1436</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">403369</td>\r\n    <td align="right"><font color="green">5524</font></td>\r\n        \r\n <td align="right" colspan="2">862313</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1315911</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1558028</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1664745</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1775021</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1880909</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2043020</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2178681</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2286379</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2399205</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl32_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl32_Label1">32</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl32_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl32_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GONDA&district_code=3147&fin_year=2015-2016&Digest=f7jNMcvW2lblcDlmOLsk0g'>GONDA</a></span></font></td>\r\n\r\n    \r\n   <td align="right">231179</td>\r\n   <td align="right"><font color="green">52250</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">524218</td>\r\n    <td align="right"><font color="green">57536</font></td>\r\n        \r\n <td align="right" colspan="2">977558</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1307701</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1582187</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1837256</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2110782</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2503893</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3036541</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3452613</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3729475</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4055719</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl33_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl33_Label1">33</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl33_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl33_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GORAKHPUR&district_code=3154&fin_year=2015-2016&Digest=TtBqhRvifl9kl9ajhafFvQ'>GORAKHPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">217869</td>\r\n   <td align="right"><font color="green">33652</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">665488</td>\r\n    <td align="right"><font color="green">64982</font></td>\r\n        \r\n <td align="right" colspan="2">1337440</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1727478</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1890549</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2031600</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2176189</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2391637</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2731938</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2935421</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3083207</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3242556</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl34_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl34_Label1">34</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl34_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl34_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=HAMIRPUR&district_code=3141&fin_year=2015-2016&Digest=OvxLReiC8NcWkDUz5VX2sw'>HAMIRPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">48716</td>\r\n   <td align="right"><font color="green">36606</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">123725</td>\r\n    <td align="right"><font color="green">64764</font></td>\r\n        \r\n <td align="right" colspan="2">220982</td>\r\n   \r\n        \r\n <td align="right" colspan="2">357700</td>\r\n   \r\n        \r\n <td align="right" colspan="2">497895</td>\r\n   \r\n        \r\n <td align="right" colspan="2">675454</td>\r\n   \r\n        \r\n <td align="right" colspan="2">854943</td>\r\n   \r\n        \r\n <td align="right" colspan="2">985042</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1154011</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1293162</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1414631</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1562071</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl35_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl35_Label1">35</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl35_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl35_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=HAPUR&district_code=3182&fin_year=2015-2016&Digest=kcy9EWYl5yihl9OHC7at5g'>HAPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">638</td>\r\n   <td align="right"><font color="green">1201</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">5887</td>\r\n    <td align="right"><font color="green">1201</font></td>\r\n        \r\n <td align="right" colspan="2">13915</td>\r\n   \r\n        \r\n <td align="right" colspan="2">22183</td>\r\n   \r\n        \r\n <td align="right" colspan="2">26327</td>\r\n   \r\n        \r\n <td align="right" colspan="2">32583</td>\r\n   \r\n        \r\n <td align="right" colspan="2">38571</td>\r\n   \r\n        \r\n <td align="right" colspan="2">42994</td>\r\n   \r\n        \r\n <td align="right" colspan="2">48863</td>\r\n   \r\n        \r\n <td align="right" colspan="2">53653</td>\r\n   \r\n        \r\n <td align="right" colspan="2">57447</td>\r\n   \r\n        \r\n <td align="right" colspan="2">62927</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl36_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl36_Label1">36</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl36_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl36_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=HARDOI&district_code=3130&fin_year=2015-2016&Digest=gd49z0QD8bp9nbwqEF4nUA'>HARDOI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">273942</td>\r\n   <td align="right"><font color="green">75570</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">672768</td>\r\n    <td align="right"><font color="green">106806</font></td>\r\n        \r\n <td align="right" colspan="2">1381677</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2034557</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2458101</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2943852</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3436464</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3883535</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4377062</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4737498</td>\r\n   \r\n        \r\n <td align="right" colspan="2">5059568</td>\r\n   \r\n        \r\n <td align="right" colspan="2">5409536</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl37_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl37_Label1">37</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl37_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl37_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=HATHRAS&district_code=3166&fin_year=2015-2016&Digest=PKmK9ZyUYJg8100Jzf8pRA'>HATHRAS</a></span></font></td>\r\n\r\n    \r\n   <td align="right">10626</td>\r\n   <td align="right"><font color="green">7490</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">51196</td>\r\n    <td align="right"><font color="green">12622</font></td>\r\n        \r\n <td align="right" colspan="2">142613</td>\r\n   \r\n        \r\n <td align="right" colspan="2">244467</td>\r\n   \r\n        \r\n <td align="right" colspan="2">301155</td>\r\n   \r\n        \r\n <td align="right" colspan="2">378651</td>\r\n   \r\n        \r\n <td align="right" colspan="2">445669</td>\r\n   \r\n        \r\n <td align="right" colspan="2">483205</td>\r\n   \r\n        \r\n <td align="right" colspan="2">536204</td>\r\n   \r\n        \r\n <td align="right" colspan="2">572923</td>\r\n   \r\n        \r\n <td align="right" colspan="2">593690</td>\r\n   \r\n        \r\n <td align="right" colspan="2">622119</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl38_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl38_Label1">38</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl38_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl38_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=JALAUN&district_code=3138&fin_year=2015-2016&Digest=sOKzEhwdMaLzFrHoxHJWXw'>JALAUN</a></span></font></td>\r\n\r\n    \r\n   <td align="right">60816</td>\r\n   <td align="right"><font color="green">24580</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">236306</td>\r\n    <td align="right"><font color="green">32894</font></td>\r\n        \r\n <td align="right" colspan="2">526392</td>\r\n   \r\n        \r\n <td align="right" colspan="2">875450</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1145380</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1429274</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1755155</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1997260</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2233710</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2367561</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2525749</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2698176</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl39_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl39_Label1">39</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl39_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl39_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=JAUNPUR&district_code=3158&fin_year=2015-2016&Digest=4QMZTGSemHkKeFCc7v2a+g'>JAUNPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">172045</td>\r\n   <td align="right"><font color="green">161702</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">472497</td>\r\n    <td align="right"><font color="green">199160</font></td>\r\n        \r\n <td align="right" colspan="2">882463</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1246644</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1452732</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1652909</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1903177</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2164610</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2480016</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2723992</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2886427</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3126867</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl40_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl40_Label1">40</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl40_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl40_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=JHANSI&district_code=3139&fin_year=2015-2016&Digest=pZwS80KG1fPS1DBPAM8Tew'>JHANSI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">156059</td>\r\n   <td align="right"><font color="green">141360</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">370213</td>\r\n    <td align="right"><font color="green">193279</font></td>\r\n        \r\n <td align="right" colspan="2">701738</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1024674</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1239996</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1506616</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1818065</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2112582</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2414127</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2653567</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2830182</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3076539</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl41_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl41_Label1">41</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl41_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl41_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KANNAUJ&district_code=3168&fin_year=2015-2016&Digest=Nh3HYATqzjsXGAtlW0pM/g'>KANNAUJ</a></span></font></td>\r\n\r\n    \r\n   <td align="right">34164</td>\r\n   <td align="right"><font color="green">33341</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">141873</td>\r\n    <td align="right"><font color="green">47098</font></td>\r\n        \r\n <td align="right" colspan="2">280199</td>\r\n   \r\n        \r\n <td align="right" colspan="2">365791</td>\r\n   \r\n        \r\n <td align="right" colspan="2">477866</td>\r\n   \r\n        \r\n <td align="right" colspan="2">595554</td>\r\n   \r\n        \r\n <td align="right" colspan="2">719466</td>\r\n   \r\n        \r\n <td align="right" colspan="2">817198</td>\r\n   \r\n        \r\n <td align="right" colspan="2">958767</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1089359</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1203555</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1293561</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl42_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl42_Label1">42</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl42_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl42_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KANPUR+DEHAT&district_code=3136&fin_year=2015-2016&Digest=hIWMlZ2OJiSGwCEr55nUug'>KANPUR DEHAT</a></span></font></td>\r\n\r\n    \r\n   <td align="right">73152</td>\r\n   <td align="right"><font color="green">17218</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">163376</td>\r\n    <td align="right"><font color="green">22139</font></td>\r\n        \r\n <td align="right" colspan="2">336233</td>\r\n   \r\n        \r\n <td align="right" colspan="2">487274</td>\r\n   \r\n        \r\n <td align="right" colspan="2">592701</td>\r\n   \r\n        \r\n <td align="right" colspan="2">739275</td>\r\n   \r\n        \r\n <td align="right" colspan="2">881735</td>\r\n   \r\n        \r\n <td align="right" colspan="2">971295</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1107326</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1211568</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1283521</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1388819</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl43_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl43_Label1">43</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl43_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl43_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KANPUR+NAGAR&district_code=3137&fin_year=2015-2016&Digest=G7pG9UzX3GDzaTcLMNJ5Xg'>KANPUR NAGAR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">54753</td>\r\n   <td align="right"><font color="green">58491</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">128331</td>\r\n    <td align="right"><font color="green">70764</font></td>\r\n        \r\n <td align="right" colspan="2">245693</td>\r\n   \r\n        \r\n <td align="right" colspan="2">351098</td>\r\n   \r\n        \r\n <td align="right" colspan="2">407292</td>\r\n   \r\n        \r\n <td align="right" colspan="2">481635</td>\r\n   \r\n        \r\n <td align="right" colspan="2">568135</td>\r\n   \r\n        \r\n <td align="right" colspan="2">643943</td>\r\n   \r\n        \r\n <td align="right" colspan="2">763236</td>\r\n   \r\n        \r\n <td align="right" colspan="2">854991</td>\r\n   \r\n        \r\n <td align="right" colspan="2">893213</td>\r\n   \r\n        \r\n <td align="right" colspan="2">941878</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl44_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl44_Label1">44</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl44_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl44_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KASHGANJ&district_code=3180&fin_year=2015-2016&Digest=vJJr/qG+DLqFBtBmapejOw'>KASHGANJ</a></span></font></td>\r\n\r\n    \r\n   <td align="right">51558</td>\r\n   <td align="right"><font color="green">8083</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">135887</td>\r\n    <td align="right"><font color="green">11970</font></td>\r\n        \r\n <td align="right" colspan="2">283572</td>\r\n   \r\n        \r\n <td align="right" colspan="2">450508</td>\r\n   \r\n        \r\n <td align="right" colspan="2">560379</td>\r\n   \r\n        \r\n <td align="right" colspan="2">715815</td>\r\n   \r\n        \r\n <td align="right" colspan="2">818507</td>\r\n   \r\n        \r\n <td align="right" colspan="2">931171</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1091857</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1235419</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1280665</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1342129</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl45_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl45_Label1">45</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl45_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl45_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KAUSHAMBI&district_code=3170&fin_year=2015-2016&Digest=fwjSQEvPcnKAALKsXB6xog'>KAUSHAMBI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">77469</td>\r\n   <td align="right"><font color="green">9547</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">195131</td>\r\n    <td align="right"><font color="green">11360</font></td>\r\n        \r\n <td align="right" colspan="2">439078</td>\r\n   \r\n        \r\n <td align="right" colspan="2">566321</td>\r\n   \r\n        \r\n <td align="right" colspan="2">682808</td>\r\n   \r\n        \r\n <td align="right" colspan="2">799060</td>\r\n   \r\n        \r\n <td align="right" colspan="2">915417</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1033088</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1171941</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1278053</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1363480</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1461586</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl46_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl46_Label1">46</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl46_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl46_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KHERI&district_code=3128&fin_year=2015-2016&Digest=xn4lgTpI1/Iafs4//7kWTQ'>KHERI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">103039</td>\r\n   <td align="right"><font color="green">43719</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">374567</td>\r\n    <td align="right"><font color="green">65083</font></td>\r\n        \r\n <td align="right" colspan="2">896837</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1359282</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1592347</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1781008</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2100688</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2588422</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3224596</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3600630</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3921590</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4274560</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl47_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl47_Label1">47</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl47_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl47_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KUSHI+NAGAR&district_code=3172&fin_year=2015-2016&Digest=KIos3qdC4R5n/tiHp0aghg'>KUSHI NAGAR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">157079</td>\r\n   <td align="right"><font color="green">12651</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">645828</td>\r\n    <td align="right"><font color="green">30399</font></td>\r\n        \r\n <td align="right" colspan="2">1340703</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1515445</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1588108</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1657680</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1764775</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1981426</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2438810</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2794858</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3140405</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3451369</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl48_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl48_Label1">48</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl48_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl48_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=LALITPUR&district_code=3140&fin_year=2015-2016&Digest=dMHkvDN3Itf9gT5e0hIqww'>LALITPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">129923</td>\r\n   <td align="right"><font color="green">126793</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">330884</td>\r\n    <td align="right"><font color="green">166209</font></td>\r\n        \r\n <td align="right" colspan="2">706864</td>\r\n   \r\n        \r\n <td align="right" colspan="2">968903</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1075969</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1241616</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1472661</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1713140</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1997938</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2249754</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2481735</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2696674</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl49_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl49_Label1">49</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl49_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl49_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=LUCKNOW&district_code=3132&fin_year=2015-2016&Digest=C9YNomBZGq/Js9JEB9c0bA'>LUCKNOW</a></span></font></td>\r\n\r\n    \r\n   <td align="right">30088</td>\r\n   <td align="right"><font color="green">29303</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">140606</td>\r\n    <td align="right"><font color="green">36274</font></td>\r\n        \r\n <td align="right" colspan="2">302330</td>\r\n   \r\n        \r\n <td align="right" colspan="2">462905</td>\r\n   \r\n        \r\n <td align="right" colspan="2">676582</td>\r\n   \r\n        \r\n <td align="right" colspan="2">885313</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1068541</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1209838</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1434505</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1636565</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1794196</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1968436</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl50_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl50_Label1">50</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl50_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl50_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MAHARAJGANJ&district_code=3152&fin_year=2015-2016&Digest=sj0gR5cslIFPUQxBKUvraw'>MAHARAJGANJ</a></span></font></td>\r\n\r\n    \r\n   <td align="right">156006</td>\r\n   <td align="right"><font color="green">18279</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">717152</td>\r\n    <td align="right"><font color="green">26200</font></td>\r\n        \r\n <td align="right" colspan="2">1837558</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2134990</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2224107</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2341489</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2460251</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2823554</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3508678</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3882837</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4180026</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4423743</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl51_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl51_Label1">51</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl51_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl51_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MAHOBA&district_code=3179&fin_year=2015-2016&Digest=7kAP6J7nbVr8wd9LChAbcw'>MAHOBA</a></span></font></td>\r\n\r\n    \r\n   <td align="right">18098</td>\r\n   <td align="right"><font color="green">13995</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">80362</td>\r\n    <td align="right"><font color="green">23668</font></td>\r\n        \r\n <td align="right" colspan="2">175282</td>\r\n   \r\n        \r\n <td align="right" colspan="2">257370</td>\r\n   \r\n        \r\n <td align="right" colspan="2">314096</td>\r\n   \r\n        \r\n <td align="right" colspan="2">379622</td>\r\n   \r\n        \r\n <td align="right" colspan="2">450185</td>\r\n   \r\n        \r\n <td align="right" colspan="2">529062</td>\r\n   \r\n        \r\n <td align="right" colspan="2">605515</td>\r\n   \r\n        \r\n <td align="right" colspan="2">671173</td>\r\n   \r\n        \r\n <td align="right" colspan="2">726667</td>\r\n   \r\n        \r\n <td align="right" colspan="2">781094</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl52_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl52_Label1">52</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl52_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl52_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MAINPURI&district_code=3123&fin_year=2015-2016&Digest=jxz213tlJXD2FrjYbOMJtQ'>MAINPURI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">27301</td>\r\n   <td align="right"><font color="green">7258</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">99259</td>\r\n    <td align="right"><font color="green">13288</font></td>\r\n        \r\n <td align="right" colspan="2">266521</td>\r\n   \r\n        \r\n <td align="right" colspan="2">401795</td>\r\n   \r\n        \r\n <td align="right" colspan="2">488790</td>\r\n   \r\n        \r\n <td align="right" colspan="2">600993</td>\r\n   \r\n        \r\n <td align="right" colspan="2">703673</td>\r\n   \r\n        \r\n <td align="right" colspan="2">783881</td>\r\n   \r\n        \r\n <td align="right" colspan="2">871720</td>\r\n   \r\n        \r\n <td align="right" colspan="2">947842</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1007479</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1143528</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl53_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl53_Label1">53</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl53_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl53_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MATHURA&district_code=3119&fin_year=2015-2016&Digest=6xFJAV8hh4yBWUkb0HGPPw'>MATHURA</a></span></font></td>\r\n\r\n    \r\n   <td align="right">29942</td>\r\n   <td align="right"><font color="green">7504</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">85988</td>\r\n    <td align="right"><font color="green">8086</font></td>\r\n        \r\n <td align="right" colspan="2">210677</td>\r\n   \r\n        \r\n <td align="right" colspan="2">338522</td>\r\n   \r\n        \r\n <td align="right" colspan="2">391298</td>\r\n   \r\n        \r\n <td align="right" colspan="2">454252</td>\r\n   \r\n        \r\n <td align="right" colspan="2">514243</td>\r\n   \r\n        \r\n <td align="right" colspan="2">584100</td>\r\n   \r\n        \r\n <td align="right" colspan="2">638408</td>\r\n   \r\n        \r\n <td align="right" colspan="2">683362</td>\r\n   \r\n        \r\n <td align="right" colspan="2">707395</td>\r\n   \r\n        \r\n <td align="right" colspan="2">750932</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl54_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl54_Label1">54</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl54_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl54_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MAU&district_code=3156&fin_year=2015-2016&Digest=h7/IRYI1eT1ggifIDW1nrw'>MAU</a></span></font></td>\r\n\r\n    \r\n   <td align="right">129711</td>\r\n   <td align="right"><font color="green">28913</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">317978</td>\r\n    <td align="right"><font color="green">36513</font></td>\r\n        \r\n <td align="right" colspan="2">657136</td>\r\n   \r\n        \r\n <td align="right" colspan="2">970123</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1166047</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1304834</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1436635</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1562699</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1739928</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1860219</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1940667</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2054045</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl55_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl55_Label1">55</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl55_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl55_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MEERUT&district_code=3115&fin_year=2015-2016&Digest=5+rxiDNJP9Bn3ZM37ZfsRA'>MEERUT</a></span></font></td>\r\n\r\n    \r\n   <td align="right">6822</td>\r\n   <td align="right"><font color="green">1435</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">29607</td>\r\n    <td align="right"><font color="green">5938</font></td>\r\n        \r\n <td align="right" colspan="2">69426</td>\r\n   \r\n        \r\n <td align="right" colspan="2">116457</td>\r\n   \r\n        \r\n <td align="right" colspan="2">140824</td>\r\n   \r\n        \r\n <td align="right" colspan="2">166200</td>\r\n   \r\n        \r\n <td align="right" colspan="2">189461</td>\r\n   \r\n        \r\n <td align="right" colspan="2">212732</td>\r\n   \r\n        \r\n <td align="right" colspan="2">239635</td>\r\n   \r\n        \r\n <td align="right" colspan="2">261249</td>\r\n   \r\n        \r\n <td align="right" colspan="2">280089</td>\r\n   \r\n        \r\n <td align="right" colspan="2">311591</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl56_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl56_Label1">56</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl56_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl56_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MIRZAPUR&district_code=3162&fin_year=2015-2016&Digest=KH7eaVtFteecWtLZ4Ahamw'>MIRZAPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">87493</td>\r\n   <td align="right"><font color="green">31704</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">228216</td>\r\n    <td align="right"><font color="green">43374</font></td>\r\n        \r\n <td align="right" colspan="2">466568</td>\r\n   \r\n        \r\n <td align="right" colspan="2">728966</td>\r\n   \r\n        \r\n <td align="right" colspan="2">858343</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1012235</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1149893</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1273889</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1427265</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1578677</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1666742</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1766578</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl57_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl57_Label1">57</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl57_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl57_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MORADABAD&district_code=3110&fin_year=2015-2016&Digest=7W94QjqLQXCEDeqXmMLlHg'>MORADABAD</a></span></font></td>\r\n\r\n    \r\n   <td align="right">67677</td>\r\n   <td align="right"><font color="green">27896</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">202712</td>\r\n    <td align="right"><font color="green">40083</font></td>\r\n        \r\n <td align="right" colspan="2">429734</td>\r\n   \r\n        \r\n <td align="right" colspan="2">564665</td>\r\n   \r\n        \r\n <td align="right" colspan="2">661188</td>\r\n   \r\n        \r\n <td align="right" colspan="2">789277</td>\r\n   \r\n        \r\n <td align="right" colspan="2">894376</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1037540</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1198225</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1309372</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1415154</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1557072</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl58_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl58_Label1">58</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl58_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl58_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MUZAFFARNAGAR&district_code=3114&fin_year=2015-2016&Digest=kMGvq9LRDZljIQI9vaMoqg'>MUZAFFARNAGAR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">9165</td>\r\n   <td align="right"><font color="green">5873</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">36097</td>\r\n    <td align="right"><font color="green">7973</font></td>\r\n        \r\n <td align="right" colspan="2">105728</td>\r\n   \r\n        \r\n <td align="right" colspan="2">173591</td>\r\n   \r\n        \r\n <td align="right" colspan="2">205313</td>\r\n   \r\n        \r\n <td align="right" colspan="2">242918</td>\r\n   \r\n        \r\n <td align="right" colspan="2">287516</td>\r\n   \r\n        \r\n <td align="right" colspan="2">321161</td>\r\n   \r\n        \r\n <td align="right" colspan="2">366145</td>\r\n   \r\n        \r\n <td align="right" colspan="2">392376</td>\r\n   \r\n        \r\n <td align="right" colspan="2">419331</td>\r\n   \r\n        \r\n <td align="right" colspan="2">472997</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl59_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl59_Label1">59</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl59_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl59_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=PILIBHIT&district_code=3126&fin_year=2015-2016&Digest=eacZIVYyYo5u8ItiEsFP9Q'>PILIBHIT</a></span></font></td>\r\n\r\n    \r\n   <td align="right">96348</td>\r\n   <td align="right"><font color="green">7881</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">234760</td>\r\n    <td align="right"><font color="green">10705</font></td>\r\n        \r\n <td align="right" colspan="2">569528</td>\r\n   \r\n        \r\n <td align="right" colspan="2">810442</td>\r\n   \r\n        \r\n <td align="right" colspan="2">947720</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1085667</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1241856</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1430975</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1618073</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1745907</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1827079</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1953122</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl60_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl60_Label1">60</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl60_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl60_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=PRATAPGARH&district_code=3144&fin_year=2015-2016&Digest=3IOQfAuGAY+s2fH19Z2t3Q'>PRATAPGARH</a></span></font></td>\r\n\r\n    \r\n   <td align="right">104175</td>\r\n   <td align="right"><font color="green">82066</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">255127</td>\r\n    <td align="right"><font color="green">103023</font></td>\r\n        \r\n <td align="right" colspan="2">553464</td>\r\n   \r\n        \r\n <td align="right" colspan="2">902844</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1154458</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1453032</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1737122</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2001379</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2360901</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2622183</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2881101</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3143695</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl61_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl61_Label1">61</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl61_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl61_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=RAE+BARELI&district_code=3133&fin_year=2015-2016&Digest=CRvBbLlz/MtBEExCbAjs/g'>RAE BARELI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">144598</td>\r\n   <td align="right"><font color="green">72819</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">385650</td>\r\n    <td align="right"><font color="green">106534</font></td>\r\n        \r\n <td align="right" colspan="2">748877</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1073897</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1408625</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1687055</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1888558</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2076399</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2446279</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2789483</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3089734</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3318954</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl62_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl62_Label1">62</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl62_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl62_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=RAMPUR&district_code=3111&fin_year=2015-2016&Digest=mIJY4Dms+BUISJYFPvzMjA'>RAMPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">49773</td>\r\n   <td align="right"><font color="green">1252</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">163750</td>\r\n    <td align="right"><font color="green">8758</font></td>\r\n        \r\n <td align="right" colspan="2">345532</td>\r\n   \r\n        \r\n <td align="right" colspan="2">532582</td>\r\n   \r\n        \r\n <td align="right" colspan="2">690400</td>\r\n   \r\n        \r\n <td align="right" colspan="2">839711</td>\r\n   \r\n        \r\n <td align="right" colspan="2">969086</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1107377</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1272427</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1375489</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1432654</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1521889</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl63_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl63_Label1">63</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl63_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl63_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SAHARANPUR&district_code=3112&fin_year=2015-2016&Digest=aFZ1f2CbV6GzQWpp3dUoJg'>SAHARANPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">14952</td>\r\n   <td align="right"><font color="green">5818</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">61084</td>\r\n    <td align="right"><font color="green">9401</font></td>\r\n        \r\n <td align="right" colspan="2">178558</td>\r\n   \r\n        \r\n <td align="right" colspan="2">232594</td>\r\n   \r\n        \r\n <td align="right" colspan="2">270374</td>\r\n   \r\n        \r\n <td align="right" colspan="2">316130</td>\r\n   \r\n        \r\n <td align="right" colspan="2">370054</td>\r\n   \r\n        \r\n <td align="right" colspan="2">420740</td>\r\n   \r\n        \r\n <td align="right" colspan="2">475728</td>\r\n   \r\n        \r\n <td align="right" colspan="2">525207</td>\r\n   \r\n        \r\n <td align="right" colspan="2">576699</td>\r\n   \r\n        \r\n <td align="right" colspan="2">631623</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl64_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl64_Label1">64</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl64_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl64_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SAMBHAL&district_code=3184&fin_year=2015-2016&Digest=GvkYcW3sqI9VwC1NFgqDzQ'>SAMBHAL</a></span></font></td>\r\n\r\n    \r\n   <td align="right">53009</td>\r\n   <td align="right"><font color="green">28367</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">179612</td>\r\n    <td align="right"><font color="green">46868</font></td>\r\n        \r\n <td align="right" colspan="2">417113</td>\r\n   \r\n        \r\n <td align="right" colspan="2">578002</td>\r\n   \r\n        \r\n <td align="right" colspan="2">687329</td>\r\n   \r\n        \r\n <td align="right" colspan="2">849560</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1023595</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1149302</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1328114</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1466208</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1567426</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1741352</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl65_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl65_Label1">65</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl65_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl65_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SANT+KABEER+NAGAR&district_code=3174&fin_year=2015-2016&Digest=PFKPk3aR+6vF/yDpFhJhrg'>SANT KABEER NAGAR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">119544</td>\r\n   <td align="right"><font color="green">42647</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">338769</td>\r\n    <td align="right"><font color="green">62718</font></td>\r\n        \r\n <td align="right" colspan="2">857248</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1080007</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1159726</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1221052</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1295873</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1475256</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1787116</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2006614</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2187255</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2354773</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl66_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl66_Label1">66</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl66_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl66_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SANT+RAVIDAS+NAGAR&district_code=3173&fin_year=2015-2016&Digest=he+WnM4MonkdfEHj7l2+zg'>SANT RAVIDAS NAGAR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">47647</td>\r\n   <td align="right"><font color="green">24136</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">103626</td>\r\n    <td align="right"><font color="green">27584</font></td>\r\n        \r\n <td align="right" colspan="2">204663</td>\r\n   \r\n        \r\n <td align="right" colspan="2">335005</td>\r\n   \r\n        \r\n <td align="right" colspan="2">405374</td>\r\n   \r\n        \r\n <td align="right" colspan="2">478164</td>\r\n   \r\n        \r\n <td align="right" colspan="2">561669</td>\r\n   \r\n        \r\n <td align="right" colspan="2">645935</td>\r\n   \r\n        \r\n <td align="right" colspan="2">757992</td>\r\n   \r\n        \r\n <td align="right" colspan="2">829754</td>\r\n   \r\n        \r\n <td align="right" colspan="2">903657</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1019012</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl67_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl67_Label1">67</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl67_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl67_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SHAHJAHANPUR&district_code=3127&fin_year=2015-2016&Digest=c2C9B5L/TH1bbtYmxCLu5A'>SHAHJAHANPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">85704</td>\r\n   <td align="right"><font color="green">68755</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">289735</td>\r\n    <td align="right"><font color="green">94889</font></td>\r\n        \r\n <td align="right" colspan="2">655810</td>\r\n   \r\n        \r\n <td align="right" colspan="2">928644</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1080647</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1254368</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1462696</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1684732</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1956111</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2131773</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2202827</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2327709</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl68_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl68_Label1">68</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl68_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl68_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SHAMLI&district_code=3183&fin_year=2015-2016&Digest=macK0Hjy5bvSlmGaZ3BDHg'>SHAMLI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">8509</td>\r\n   <td align="right"><font color="green">2873</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">23551</td>\r\n    <td align="right"><font color="green">3979</font></td>\r\n        \r\n <td align="right" colspan="2">39094</td>\r\n   \r\n        \r\n <td align="right" colspan="2">61277</td>\r\n   \r\n        \r\n <td align="right" colspan="2">77496</td>\r\n   \r\n        \r\n <td align="right" colspan="2">92148</td>\r\n   \r\n        \r\n <td align="right" colspan="2">110086</td>\r\n   \r\n        \r\n <td align="right" colspan="2">125883</td>\r\n   \r\n        \r\n <td align="right" colspan="2">144171</td>\r\n   \r\n        \r\n <td align="right" colspan="2">159100</td>\r\n   \r\n        \r\n <td align="right" colspan="2">167424</td>\r\n   \r\n        \r\n <td align="right" colspan="2">181440</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl69_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl69_Label1">69</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl69_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl69_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SHRAVASTI&district_code=3176&fin_year=2015-2016&Digest=/s34qzJzvDLIchb/K19PEw'>SHRAVASTI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">64032</td>\r\n   <td align="right"><font color="green">21317</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">155188</td>\r\n    <td align="right"><font color="green">24694</font></td>\r\n        \r\n <td align="right" colspan="2">310961</td>\r\n   \r\n        \r\n <td align="right" colspan="2">445643</td>\r\n   \r\n        \r\n <td align="right" colspan="2">524295</td>\r\n   \r\n        \r\n <td align="right" colspan="2">600998</td>\r\n   \r\n        \r\n <td align="right" colspan="2">684715</td>\r\n   \r\n        \r\n <td align="right" colspan="2">784401</td>\r\n   \r\n        \r\n <td align="right" colspan="2">986620</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1180824</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1345679</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1492167</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl70_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl70_Label1">70</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl70_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl70_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SIDDHARTH+NAGAR&district_code=3151&fin_year=2015-2016&Digest=20mXKdlHbpcdy+KmePedzw'>SIDDHARTH NAGAR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">328649</td>\r\n   <td align="right"><font color="green">234680</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">949340</td>\r\n    <td align="right"><font color="green">384203</font></td>\r\n        \r\n <td align="right" colspan="2">1929067</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2379116</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2565984</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2700625</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2960446</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3381661</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3915184</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4218656</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4626257</td>\r\n   \r\n        \r\n <td align="right" colspan="2">5190022</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl71_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl71_Label1">71</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl71_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl71_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SITAPUR&district_code=3129&fin_year=2015-2016&Digest=u+ZVcHNC3ux1zufx7NZXWw'>SITAPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">223992</td>\r\n   <td align="right"><font color="green">228247</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">651052</td>\r\n    <td align="right"><font color="green">298512</font></td>\r\n        \r\n <td align="right" colspan="2">1372104</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2068369</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2527003</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3039732</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3647671</td>\r\n   \r\n        \r\n <td align="right" colspan="2">4303507</td>\r\n   \r\n        \r\n <td align="right" colspan="2">5183362</td>\r\n   \r\n        \r\n <td align="right" colspan="2">5991901</td>\r\n   \r\n        \r\n <td align="right" colspan="2">6697013</td>\r\n   \r\n        \r\n <td align="right" colspan="2">7184273</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl72_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl72_Label1">72</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl72_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl72_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SONBHADRA&district_code=3163&fin_year=2015-2016&Digest=gAL5a/1WWY6pR37Oz08oQg'>SONBHADRA</a></span></font></td>\r\n\r\n    \r\n   <td align="right">175016</td>\r\n   <td align="right"><font color="green">88791</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">369800</td>\r\n    <td align="right"><font color="green">106023</font></td>\r\n        \r\n <td align="right" colspan="2">678029</td>\r\n   \r\n        \r\n <td align="right" colspan="2">999673</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1197139</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1481431</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1731108</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1912176</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2141370</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2296868</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2528548</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2697015</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl73_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl73_Label1">73</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl73_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl73_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SULTANPUR&district_code=3150&fin_year=2015-2016&Digest=Lb0Dftv59CbF4wdp9+v3Sg'>SULTANPUR</a></span></font></td>\r\n\r\n    \r\n   <td align="right">146087</td>\r\n   <td align="right"><font color="green">72137</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">268657</td>\r\n    <td align="right"><font color="green">77214</font></td>\r\n        \r\n <td align="right" colspan="2">467367</td>\r\n   \r\n        \r\n <td align="right" colspan="2">645687</td>\r\n   \r\n        \r\n <td align="right" colspan="2">743696</td>\r\n   \r\n        \r\n <td align="right" colspan="2">893354</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1048486</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1227644</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1459976</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1649332</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1807414</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2004288</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl74_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl74_Label1">74</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl74_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl74_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=UNNAO&district_code=3131&fin_year=2015-2016&Digest=ywyUTDQiQ5Qbb17VY/v8ig'>UNNAO</a></span></font></td>\r\n\r\n    \r\n   <td align="right">141378</td>\r\n   <td align="right"><font color="green">55704</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">427940</td>\r\n    <td align="right"><font color="green">90567</font></td>\r\n        \r\n <td align="right" colspan="2">909813</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1271991</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1461413</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1733643</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2032867</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2286920</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2663550</td>\r\n   \r\n        \r\n <td align="right" colspan="2">2968868</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3301410</td>\r\n   \r\n        \r\n <td align="right" colspan="2">3792388</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl75_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl75_Label1">75</span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl75_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl75_Label2"><a href='projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=VARANASI&district_code=3161&fin_year=2015-2016&Digest=kzr4B6DvbVSIn8/iA2/ZhQ'>VARANASI</a></span></font></td>\r\n\r\n    \r\n   <td align="right">40330</td>\r\n   <td align="right"><font color="green">23335</font></td>\r\n   \r\n    \r\n    \r\n    <td align="right">146544</td>\r\n    <td align="right"><font color="green">39753</font></td>\r\n        \r\n <td align="right" colspan="2">329800</td>\r\n   \r\n        \r\n <td align="right" colspan="2">514687</td>\r\n   \r\n        \r\n <td align="right" colspan="2">607467</td>\r\n   \r\n        \r\n <td align="right" colspan="2">688019</td>\r\n   \r\n        \r\n <td align="right" colspan="2">769755</td>\r\n   \r\n        \r\n <td align="right" colspan="2">841543</td>\r\n   \r\n        \r\n <td align="right" colspan="2">934882</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1006720</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1082864</td>\r\n   \r\n        \r\n <td align="right" colspan="2">1197113</td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n    <tr>\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl76_td1" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl76_Label1"></span></font></td>\r\n\r\n    <td id="ctl00_ContentPlaceHolder1_Repeater1_ctl76_td7" align="left"><font face="verdana" size="2"><span id="ctl00_ContentPlaceHolder1_Repeater1_ctl76_Label2">Total</span></font></td>\r\n\r\n    \r\n   <td align="right"><b>6768862</b></td>\r\n   <td align="right"><font color="green"><b>3370590</b></font></td>\r\n   \r\n    \r\n    \r\n    <td align="right"><b>19881060</b></td>\r\n    <td align="right"><font color="green"><b>4754075</b></font></td>\r\n        \r\n <td align="right" colspan="2"><b>42769323</b></td>\r\n   \r\n        \r\n <td align="right" colspan="2"><b>59949953</b></td>\r\n   \r\n        \r\n <td align="right" colspan="2"><b>71002664</b></td>\r\n   \r\n        \r\n <td align="right" colspan="2"><b>82601592</b></td>\r\n   \r\n        \r\n <td align="right" colspan="2"><b>94747527</b></td>\r\n   \r\n        \r\n <td align="right" colspan="2"><b>107674795</b></td>\r\n   \r\n        \r\n <td align="right" colspan="2"><b>125695330</b></td>\r\n   \r\n        \r\n <td align="right" colspan="2"><b>139461677</b></td>\r\n   \r\n        \r\n <td align="right" colspan="2"><b>150710112</b></td>\r\n   \r\n        \r\n <td align="right" colspan="2"><b>163233833</b></td>\r\n   \r\n    \r\n  </tr>\r\n    \r\n\r\n\r\n   <table width="100%">\r\n   <tr>\r\n   <td align="center">\r\n   <b><a id="ctl00_ContentPlaceHolder1_LinkButton1" href="javascript:__doPostBack('ctl00$ContentPlaceHolder1$LinkButton1','')"><u><font color="Blue"><b>Download in Excel View</b></font></u></a></b>\r\n   </td>\r\n   </tr>\r\n   </table>\r\n\r\n    </center>\r\n\r\n\r\n\r\n\r\n    </div>\r\n    </form>\r\n</body>\r\n</html>\r\n	\N	\N
3	1	{"AGRA":"65679","ALIGARH":"13913","ALLAHABAD":"120864","AMBEDKAR NAGAR":"143816","AMETHI":"152171","AMROHA":"138766","AURAIYA":"29132","AZAMGARH":"184543","BAGHPAT":"1950","BAHRAICH":"85219","BALLIA":"25430","BALRAMPUR":"16205","BANDA":"113321","BARABANKI":"63687","BAREILLY":"36230","BASTI":"144514","BIJNOR":"77043","BUDAUN":"43917","BULANDSHAHR":"10887","CHANDAULI":"45747","CHITRAKOOT":"80301","DEORIA":"53063","ETAH":"21513","ETAWAH":"12493","FAIZABAD":"98054","FARRUKHABAD":"9914","FATEHPUR":"25380","FIROZABAD":"39711","GAUTAM BUDDHA NAGAR":"0","GHAZIABAD":"0","GHAZIPUR":"5524","GONDA":"57536","GORAKHPUR":"64982","HAMIRPUR":"64764","HAPUR":"1201","HARDOI":"106806","HATHRAS":"12622","JALAUN":"32894","JAUNPUR":"199160","JHANSI":"193279","KANNAUJ":"47098","KANPUR DEHAT":"22139","KANPUR NAGAR":"70764","KASHGANJ":"11970","KAUSHAMBI":"11360","KHERI":"65083","KUSHI NAGAR":"30399","LALITPUR":"166209","LUCKNOW":"36274","MAHARAJGANJ":"26200","MAHOBA":"23668","MAINPURI":"13288","MATHURA":"8086","MAU":"36513","MEERUT":"5938","MIRZAPUR":"43374","MORADABAD":"40083","MUZAFFARNAGAR":"7973","PILIBHIT":"10705","PRATAPGARH":"103023","RAE BARELI":"106534","RAMPUR":"8758","SAHARANPUR":"9401","SAMBHAL":"46868","SANT KABEER NAGAR":"62718","SANT RAVIDAS NAGAR":"27584","SHAHJAHANPUR":"94889","SHAMLI":"3979","SHRAVASTI":"24694","SIDDHARTH NAGAR":"384203","SITAPUR":"298512","SONBHADRA":"106023","SULTANPUR":"77214","UNNAO":"90567","VARANASI":"39753","Total":"4754075"}	1432270618	\N	1	\N
4	1	{"AGRA":"65679","ALIGARH":"13913","ALLAHABAD":"120864","AMBEDKAR NAGAR":"143816","AMETHI":"152171","AMROHA":"138766","AURAIYA":"29132","AZAMGARH":"184543","BAGHPAT":"1950","BAHRAICH":"85219","BALLIA":"25430","BALRAMPUR":"16205","BANDA":"113321","BARABANKI":"63687","BAREILLY":"36230","BASTI":"144514","BIJNOR":"77043","BUDAUN":"43917","BULANDSHAHR":"10887","CHANDAULI":"45747","CHITRAKOOT":"80301","DEORIA":"53063","ETAH":"21513","ETAWAH":"12493","FAIZABAD":"98054","FARRUKHABAD":"9914","FATEHPUR":"25380","FIROZABAD":"39711","GAUTAM BUDDHA NAGAR":"0","GHAZIABAD":"0","GHAZIPUR":"5524","GONDA":"57536","GORAKHPUR":"64982","HAMIRPUR":"64764","HAPUR":"1201","HARDOI":"106806","HATHRAS":"12622","JALAUN":"32894","JAUNPUR":"199160","JHANSI":"193279","KANNAUJ":"47098","KANPUR DEHAT":"22139","KANPUR NAGAR":"70764","KASHGANJ":"11970","KAUSHAMBI":"11360","KHERI":"65083","KUSHI NAGAR":"30399","LALITPUR":"166209","LUCKNOW":"36274","MAHARAJGANJ":"26200","MAHOBA":"23668","MAINPURI":"13288","MATHURA":"8086","MAU":"36513","MEERUT":"5938","MIRZAPUR":"43374","MORADABAD":"40083","MUZAFFARNAGAR":"7973","PILIBHIT":"10705","PRATAPGARH":"103023","RAE BARELI":"106534","RAMPUR":"8758","SAHARANPUR":"9401","SAMBHAL":"46868","SANT KABEER NAGAR":"62718","SANT RAVIDAS NAGAR":"27584","SHAHJAHANPUR":"94889","SHAMLI":"3979","SHRAVASTI":"24694","SIDDHARTH NAGAR":"384203","SITAPUR":"298512","SONBHADRA":"106023","SULTANPUR":"77214","UNNAO":"90567","VARANASI":"39753","Total":"4754075"}	1432270855	\N	1	\N
5	1	{"AGRA":"65679","ALIGARH":"13913","ALLAHABAD":"120864","AMBEDKAR NAGAR":"143816","AMETHI":"152171","AMROHA":"138766","AURAIYA":"29132","AZAMGARH":"184543","BAGHPAT":"1950","BAHRAICH":"85219","BALLIA":"25430","BALRAMPUR":"16205","BANDA":"113321","BARABANKI":"63687","BAREILLY":"36230","BASTI":"144514","BIJNOR":"77043","BUDAUN":"43917","BULANDSHAHR":"10887","CHANDAULI":"45747","CHITRAKOOT":"80301","DEORIA":"53063","ETAH":"21513","ETAWAH":"12493","FAIZABAD":"98054","FARRUKHABAD":"9914","FATEHPUR":"25380","FIROZABAD":"39711","GAUTAM BUDDHA NAGAR":"0","GHAZIABAD":"0","GHAZIPUR":"5524","GONDA":"57536","GORAKHPUR":"64982","HAMIRPUR":"64764","HAPUR":"1201","HARDOI":"106806","HATHRAS":"12622","JALAUN":"32894","JAUNPUR":"199160","JHANSI":"193279","KANNAUJ":"47098","KANPUR DEHAT":"22139","KANPUR NAGAR":"70764","KASHGANJ":"11970","KAUSHAMBI":"11360","KHERI":"65083","KUSHI NAGAR":"30399","LALITPUR":"166209","LUCKNOW":"36274","MAHARAJGANJ":"26200","MAHOBA":"23668","MAINPURI":"13288","MATHURA":"8086","MAU":"36513","MEERUT":"5938","MIRZAPUR":"43374","MORADABAD":"40083","MUZAFFARNAGAR":"7973","PILIBHIT":"10705","PRATAPGARH":"103023","RAE BARELI":"106534","RAMPUR":"8758","SAHARANPUR":"9401","SAMBHAL":"46868","SANT KABEER NAGAR":"62718","SANT RAVIDAS NAGAR":"27584","SHAHJAHANPUR":"94889","SHAMLI":"3979","SHRAVASTI":"24694","SIDDHARTH NAGAR":"384203","SITAPUR":"298512","SONBHADRA":"106023","SULTANPUR":"77214","UNNAO":"90567","VARANASI":"39753","Total":"4754075"}	1432270906	\N	1	\N
6	1	{"3120":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AGRA&district_code=3120&fin_year=2015-2016&Digest=tRM0SoS+7mCALrRloE5saw","ACHHNERA":"2478","AKOLA":"10101","BAH":"4718","BARAULI AHIR":"4151","BICHPURI":"3814","ETMADPUR":"4422","FATEHABAD":"2490","FATEHPUR SIKRI":"7484","JAGNER":"7752","JAITPUR KALAN":"1273","KHANDAULI":"3855","KHERAGARH":"323","PINAHAT":"1915","SAIYAN":"8785","SHAMSABAD":"2118","Total":"65679"},"3118":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=ALIGARH&district_code=3118&fin_year=2015-2016&Digest=GXjVN5hve8A0WHOkCDOcig","AKRABAD":"655","ATRAULI":"757","BIJAULI":"1501","CHANDAUS":"58","DHANIPUR":"28","GANGIRI":"1006","GONDA":"3461","IGLAS":"98","JAWAN SIKANDERPUR":"775","KHAIR":"3359","LODHA":"1728","TAPPAL":"487","Total":"13913"},"3145":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=ALLAHABAD&district_code=3145&fin_year=2015-2016&Digest=WGDHEw0EZqr+hfoQRd7hcg","BAHADURPUR":"833","BAHRIA":"2341","CHAKA":"374","DHANUPUR":"8229","HANDIA":"17374","HOLAGARH":"13682","JASRA":"3302","KARCHHANA":"5684","KAUDHIYARA":"1964","KAURIHAR":"16189","KORAON":"2364","MANDA":"14500","MAUAIMA":"2844","MEJA":"5217","PHULPUR":"677","PRATAPPUR":"5024","SAIDABAD":"1118","SHANKARGARH":"5880","SORAON":"2557","URUWAN":"10711","Total":"120864"},"3178":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AMBEDKAR+NAGAR&district_code=3178&fin_year=2015-2016&Digest=6xCDtXIon9+woChHWRt+\\/Q","Akbarpur":"8628","Baskhari":"7189","BHITI":"9930","Bhiyawan":"22978","Jahangir Ganj":"2570","Jalal Pur":"26255","Katehari":"13541","Ram Nagar":"23689","Tanda":"29036","Total":"143816"},"3181":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AMETHI&district_code=3181&fin_year=2015-2016&Digest=ZuycpaUonoDQBJ7iNfp\\/Rg","AMETHI":"1520","BAHADURPUR":"2619","BHADAR":"8884","BHETUA":"2607","GAURIGANJ":"3246","JAGDISHPUR":"16262","JAMO":"76954","MUSAFIR KHANA":"989","SANGRAMPUR":"702","SHAHGARH":"742","SHUKUL BAZAR":"6632","SINGHPUR":"29266","TILOI":"1748","Total":"152171"},"3167":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AMROHA&district_code=3167&fin_year=2015-2016&Digest=iI+wtGgnbUaceHymdPOsfQ","AMROHA":"31150","DHANAURA":"8174","GAJRAULA":"25488","GANGESHWARI":"9909","HASANPUR":"18714","JOYA":"45331","Total":"138766"},"3169":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AURAIYA&district_code=3169&fin_year=2015-2016&Digest=t5CDGH1EsNMxDO78ppMdHg","ACHCHALDA":"753","AJITMAL":"5540","AURAIYA":"6624","BHAGYANAGAR":"7275","BIDHUNA":"1786","ERWA KATRA":"6202","SAHAR":"952","Total":"29132"},"3157":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AZAMGARH&district_code=3157&fin_year=2015-2016&Digest=cCKbpgnS6n7Kl2UatV\\/4mQ","AHIRAULA":"8251","ATRAULIA":"0","AZMATGARH":"35724","BILARIYAGANJ":"5616","HARAIYA":"22653","JAHANAGANJ":"18276","KOILSA":"8288","LALGANJ":"14094","MAHRAJGANJ":"0","MARTINGANJ":"182","MEHNAGAR":"1218","MIRZAPUR":"4677","MOHAMMADPUR":"5984","PALHANA":"1428","PALHANI":"2588","PAWAI":"17081","PHULPUR":"2856","RANI KI SARAI":"1200","SATHIYAON":"766","TAHBARPUR":"7450","TARWA":"1791","THEKMA":"24420","Total":"184543"},"3165":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BAGHPAT&district_code=3165&fin_year=2015-2016&Digest=LwvxUa8qfQ2DBZQhMV7gcQ","BAGHPAT":"262","BARAUT":"432","BINAULI":"120","CHHAPRAULI":"12","KHEKRA":"0","PILANA":"1124","Total":"1950"},"3146":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BAHRAICH&district_code=3146&fin_year=2015-2016&Digest=8BLtdj5LDp+Bk24mQcZrVA","BALAHA":"2942","CHITAURA":"1930","HUZOORPUR":"1093","JARWAL":"5404","KAISARGANJ":"10634","MAHASI":"252","MIHINPURWA":"6538","NAWABGANJ":"2881","PHAKHARPUR":"13999","PRAYAGPUR":"4667","RISIA":"14381","SHIVPUR":"2495","TAJWAPUR":"8422","VISHESHWARGANJ":"9581","Total":"85219"},"3159":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BALLIA&district_code=3159&fin_year=2015-2016&Digest=OMyuEI+dqcimT6Kfclq1JQ","Bairia":"192","Bansdih":"0","Belhari":"0","Beruarbari":"1047","CHILKAHAR":"2068","Dubhar":"0","Garwar":"0","Hanumanganj":"0","Maniar":"0","Murlichhapra":"0","NAGRA":"0","Navanagar":"0","Pandah":"0","Rasra":"0","Reoti":"0","SIAR":"10426","Sohanv":"11697","Total":"25430"},"3175":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BALRAMPUR&district_code=3175&fin_year=2015-2016&Digest=EDPasx4UtQ7\\/Yx+YEei3QQ","BALRAMPUR":"3639","GAINDAS BUJURG":"235","GAISRI":"806","HARYA SATGHARWA":"2918","PACHPEDWA":"0","REHERA BAZAR":"4177","SHRIDUTTGANJ":"2101","TULSIPUR":"796","UTRAULA":"1533","Total":"16205"},"3142":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BANDA&district_code=3142&fin_year=2015-2016&Digest=q42oZGdw\\/pHE9OSCnklbPg","BABERU":"23299","BADOKHAR KHURD":"15530","BISANDA":"12209","JASPURA":"2762","KAMASIN":"8294","MAHUVA":"16107","NARAINI":"31084","TINDWARI":"4036","Total":"113321"},"3148":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BARABANKI&district_code=3148&fin_year=2015-2016&Digest=eqwk8kXjGe41V7LVDuZ1jQ","BANI KODAR":"6943","BANKI":"2199","DARIYABAD":"0","DEWA":"814","FATEHPUR":"10232","HAIDARGARH":"3679","HARAKH":"827","MASAULI":"117","NINDURA":"18473","PUREDALAI":"2390","RAMNAGAR":"2397","SIDDHAUR":"3902","SIRAULI GAUSPUR":"8222","SURATGANJ":"959","TRIVEDIGANJ":"2533","Total":"63687"},"3125":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BAREILLY&district_code=3125&fin_year=2015-2016&Digest=HAGu+GqSWr+jgO7FWrY4Lg","AALAMPUR JAFARABAD":"2533","BAHERI":"391","BHADPURA":"5322","BHOJIPURA":"1826","BHUTA":"3881","BITHIRI CHAINPUR":"3256","FARIDPUR":"1387","FATEHGANJ WEST":"337","KYARA":"301","MAJHGAWAN":"1113","MIRGANJ":"196","NAWABGANJ":"7563","RAMNAGAR":"2569","RICHHA":"1710","SHERGARH":"3845","Total":"36230"},"3153":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BASTI&district_code=3153&fin_year=2015-2016&Digest=kQJXXKeRQaxM2vf9zup1PA","BAHADURPUR":"7656","BANKATI":"44337","BASTI":"12221","DUBAULIYA":"1128","GAUR":"1080","HARRAIYA":"10332","KAPTANGANJ":"11331","KUDARAHA":"20145","PARAS RAMPUR":"13417","RAMNAGAR":"0","RUDAULI":"9992","SALTAUA GOPAL PUR":"12059","SAU GHAT":"688","VIKRAM JOT":"128","Total":"144514"},"3109":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BIJNOR&district_code=3109&fin_year=2015-2016&Digest=+QrsBzXTft4PeQ2X3gCyzg","AFZALGARH":"10351","ALLAHPUR":"7417","BUDHANPUR SEOHARA":"7682","HALDAUR(KHARI JHALU)":"2511","JALILPUR":"13245","KIRATPUR":"1935","Kotwali":"10173","MOHAMMEDPUR DEOMAL":"632","NAJIBABAD":"15525","NEHTAUR":"3689","NOORPUR":"3883","Total":"77043"},"3124":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BUDAUN&district_code=3124&fin_year=2015-2016&Digest=nSyjuvg1Oj5BbE\\/ZF372bg","AMBIAPUR":"2570","ASAFPUR":"4474","BISAULI":"3950","DATAGANJ":"130","DEHGAWAN":"2182","ISLAMNAGAR":"2730","JAGAT":"282","MION":"5492","QADAR CHOWK":"7598","SAHASWAN":"4790","SALARPUR":"1892","SAMRER":"1012","UJHANI":"1508","USAWAN":"680","WAZIRGANJ":"4627","Total":"43917"},"3117":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BULANDSHAHR&district_code=3117&fin_year=2015-2016&Digest=WShNy3QeuaRqaYJMghSlOg","AGAUTA":"900","ANUPSHAHR":"382","ARANIYA":"949","BHAWAN BAHADUR NAGAR":"512","BULANDSHAHR":"250","DANPUR":"566","DIBAI":"492","GULAOTHI":"98","JAHANGIRABAD":"981","KHURJA":"672","LAKHAOTHI":"755","PAHASU":"0","SHIKARPUR":"55","SIKANDRABAD":"2207","SYANA":"399","UNCHAGAON":"1669","Total":"10887"},"3171":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=CHANDAULI&district_code=3171&fin_year=2015-2016&Digest=9taP8s6SuYwQDCeN0ZR6SA","Barhani":"6818","Chahniya   ":"897","Chakiya":"4265","Chandauli   ":"3027","Dhanapur":"3522","Naugarh    ":"8802","Niyamatabad       ":"9883","Sahabganj   ":"8533","Sakaldiha":"0","Total":"45747"},"3177":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=CHITRAKOOT&district_code=3177&fin_year=2015-2016&Digest=QINqS+CgjKiV7hZa9kx2Eg","Karwi":"26976","MANIKPUR":"16555","Mau":"14271","PAHARI":"16776","RAMNAGAR":"5723","Total":"80301"},"3155":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=DEORIA&district_code=3155&fin_year=2015-2016&Digest=FOj+W+IkpVE7Ri\\/A2M4hsg","BAITALPUR":"271","BANKATA":"151","BARHAJ":"5461","BHAGALPUR":"0","BHALUANI":"2386","BHATNI":"0","BHATPAR RANI":"0","DEORIA SADAR":"1650","DESAI DEORIA":"30020","GAURI BAZAR":"0","LAR":"0","PATHARDEWA":"0","RAMPUR KARKHANA":"1771","RUDRAPUR":"2113","SALEMPUR":"380","TARKULWA":"8860","Total":"53063"},"3122":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=ETAH&district_code=3122&fin_year=2015-2016&Digest=1H5CeZE8ykxBX\\/CYN3vrRw","ALIGANJ":"810","AWAGARH":"3388","JAITHARA":"0","JALESAR":"2128","MAREHRA":"468","NIDHAULI KALAN":"2417","SAKIT":"2738","SHITALPUR":"9564","Total":"21513"},"3135":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=ETAWAH&district_code=3135&fin_year=2015-2016&Digest=vnOLmMAKrTqJAJ+9rqYifQ","BARHPURA":"4954","BASREHAR":"0","BHARTHANA":"0","CHAKARNAGAR":"1908","JASWANTNAGAR":"3845","MAHEWA":"0","SEFAI":"1200","TAKHA":"586","Total":"12493"},"3149":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=FAIZABAD&district_code=3149&fin_year=2015-2016&Digest=BkB7wLUvbfEEV1\\/lMhxzIA","AMANIGANJ":"8219","BIKAPUR":"9171","HASTINGANJ":"5284","MASODHA":"1986","MAWAI":"10261","MAYA BAZAR":"7207","MILKIPUR":"22274","PURA BAZAR":"9461","Rudauli":"14431","SOHAWAL":"4928","TARUN":"4832","Total":"98054"},"3134":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=FARRUKHABAD&district_code=3134&fin_year=2015-2016&Digest=4QAPUTdeSuSWtFLNVDlfqg","BARHPUR":"380","KAIMGANJ":"2489","KAMALGANJ":"936","MOHAMADABAD":"3559","NAWABGANJ":"328","RAJEPUR":"504","SHAMSABAD":"1718","Total":"9914"},"3143":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=FATEHPUR&district_code=3143&fin_year=2015-2016&Digest=X1xqxyJzNafRf2R56ePTAg","AIRAYA":"347","AMAULI":"2585","ASODHAR":"2148","BAHUA":"0","BHITAURA":"3485","DEVMAI":"929","DHATA":"2155","HASWA":"579","HATHGAON":"6173","KHAJUHA":"1267","MALWAN":"1987","TELYANI":"1327","VIJAYIPUR":"2398","Total":"25380"},"3121":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=FIROZABAD&district_code=3121&fin_year=2015-2016&Digest=SlMefVavEAp3wQPCwi9Zsg","ARAON":"5123","EKA":"1807","FIROZABAD":"1128","JASRANA":"2314","KHERGARH":"2972","MADANPUR":"2593","NARKHI":"11184","SHIKOHABAD":"2732","TUNDLA":"9858","Total":"39711"},"3164":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GAUTAM+BUDDHA+NAGAR&district_code=3164&fin_year=2015-2016&Digest=EsPdUY7\\/8NuWxmAvaMCNEQ","Bisrakh":"0","Dadri":"0","Dankaur":"0","Jewar":"0","Total":"0"},"3116":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GHAZIABAD&district_code=3116&fin_year=2015-2016&Digest=L5HEoHozqXkaxAah2abefQ","BHOJPUR":"0","LONI":"0","MURADNAGAR":"0","RAJAPUR":"0","Total":"0"},"3160":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GHAZIPUR&district_code=3160&fin_year=2015-2016&Digest=P5v7DnUXAJnaajvr6eWE4A","BHADAURA":"260","BHANWARKOL":"412","DEVKALI":"0","GHAZIPUR":"0","JAKHANIA":"1426","KARANDA":"228","KASIMABAD":"0","MANIHARI":"0","MARDAH":"0","MOHAMMADABAD":"0","REVATIPUR":"0","SADAT":"1494","SAIDPUR":"0","VARACHAKWAR":"0","VIRNO":"1704","ZAMANIA":"0","Total":"5524"},"3147":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GONDA&district_code=3147&fin_year=2015-2016&Digest=f7jNMcvW2lblcDlmOLsk0g","BABHANJOT":"0","BELSAR":"1803","CHHAPIA":"992","COLONELGANJ":"3485","HALDHARMAU":"11051","ITIATHOK":"0","JHANJHARI":"0","KATRA BAZAR":"480","MANKAPUR":"360","MUJEHANA":"282","NAWABGANJ":"5559","PANDRI KRIPAL":"31078","PARASPUR":"0","RUPAIDEEH":"2446","TARABGANJ":"0","WAZIRGANJ":"0","Total":"57536"},"3154":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GORAKHPUR&district_code=3154&fin_year=2015-2016&Digest=TtBqhRvifl9kl9ajhafFvQ","BANSGAON":"3482","BARHALGANJ":"3741","BELGHAT":"1572","BHATHAT":"10755","BRAHMPUR":"7133","CAMPIERGANJ":"4475","CHIRGAWAN":"1753","GAUGAHA":"8239","GOLA":"769","JANGAL KODIA":"853","KAURI RAM":"30","KHAJANI":"1960","KHORABAR":"2707","PALI":"148","PIPRAICH":"2505","PIPRAULI":"522","SAHJANAWA":"10840","SARDARNAGAR":"600","URUWA":"2898","Total":"64982"},"3141":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=HAMIRPUR&district_code=3141&fin_year=2015-2016&Digest=OvxLReiC8NcWkDUz5VX2sw","GOHAND":"8610","KURARA":"13391","MAUDAHA":"16676","MUSKARA":"2055","RATH":"2341","SARILA":"13157","SUMERPUR":"8534","Total":"64764"},"3182":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=HAPUR&district_code=3182&fin_year=2015-2016&Digest=kcy9EWYl5yihl9OHC7at5g","DHAULANA":"191","GARH MUKTESHWAR":"448","HAPUR":"220","SIMBHAWALI":"342","Total":"1201"},"3130":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=HARDOI&district_code=3130&fin_year=2015-2016&Digest=gd49z0QD8bp9nbwqEF4nUA","AHRORI":"0","BAWAN":"1071","BEHADAR":"2626","BHARAWAN":"0","BHARKHANI":"5526","BILGRAM":"1035","HARIYAWAN":"6409","HARPALPUR":"0","KACHHAUNA":"334","KOTHWAN":"0","MADHOGANJ":"1947","MALLAWAN":"404","PIHANI":"2609","SANDI":"2966","SANDILA":"266","SHAHABAD":"31968","SURSA":"31994","TADIYAWAN":"705","TONDARPUR":"16946","Total":"106806"},"3166":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=HATHRAS&district_code=3166&fin_year=2015-2016&Digest=PKmK9ZyUYJg8100Jzf8pRA","HASAYAN":"0","HATHRAS":"732","MURSAN":"1042","SADABAD":"1530","Sasni":"1061","SEHPAU":"8257","SIKANDRARAO":"0","Total":"12622"},"3138":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=JALAUN&district_code=3138&fin_year=2015-2016&Digest=sOKzEhwdMaLzFrHoxHJWXw","DAKORE":"627","JALAUN":"4784","KADAURA":"11919","KONCH":"2833","KUTHAUND":"9024","MADHOGARH":"1841","MAHEVA":"21","NADIGAON":"1186","RAMPURA":"659","Total":"32894"},"3158":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=JAUNPUR&district_code=3158&fin_year=2015-2016&Digest=4QMZTGSemHkKeFCc7v2a+g","BADLA PUR":"1606","BAKSHA":"996","BARASATHI":"22315","DHARMA PUR":"2173","DOBHI":"4728","JALAL PUR":"12956","KARANJA KALA":"8933","KERAKAT":"11697","KHUTHAN":"35113","MACHCHALI SHAHAR":"4630","MAHARAJ GANJ":"7391","MARIYAHU":"781","MUFTI GANJ":"11322","MUNGRA BADSHAH PUR":"3804","RAM NAGAR":"2403","RAM PUR":"19832","SHAH GANJ":"31275","SIKRARA":"1301","SIRKONI":"2549","SUITHA KALA":"7623","SUJAN GANJ":"5732","Total":"199160"},"3139":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=JHANSI&district_code=3139&fin_year=2015-2016&Digest=pZwS80KG1fPS1DBPAM8Tew","BABINA":"5776","BADAGAON":"2344","BAMAUR":"9162","BANGRA":"101175","CHIRGAON":"5406","GURSARAI":"33442","MAURANIPUR":"23699","MOTH":"12275","Total":"193279"},"3168":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KANNAUJ&district_code=3168&fin_year=2015-2016&Digest=Nh3HYATqzjsXGAtlW0pM\\/g","CHHIBRAMAU":"6632","Gugrapur":"2147","HASERAN":"2127","JALALABAD":"1346","KANNAUJ":"12192","SAURIKH":"800","TALGRAM":"11953","UMARDA":"9901","Total":"47098"},"3136":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KANPUR+DEHAT&district_code=3136&fin_year=2015-2016&Digest=hIWMlZ2OJiSGwCEr55nUug","AKBARPUR":"3718","AMRODHA":"1296","DERAPUR":"1469","JHINJHAK":"2132","MAITHA":"820","MALASA":"654","RAJPUR":"2428","RASULABAD":"2132","SANDALPUR":"3640","SARBANKHERA":"3850","Total":"22139"},"3137":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KANPUR+NAGAR&district_code=3137&fin_year=2015-2016&Digest=G7pG9UzX3GDzaTcLMNJ5Xg","BHITARGAON":"3408","BILHAUR":"21507","CHAUBEYPUR":"7158","GHATAMPUR":"10075","KAKWAN":"8901","KALYANPUR":"1531","PATARA":"2874","SARSOL":"7975","SHIVRAJPUR":"5529","VIDHUNU":"1806","Total":"70764"},"3180":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KASHGANJ&district_code=3180&fin_year=2015-2016&Digest=vJJr\\/qG+DLqFBtBmapejOw","AMANPUR":"3018","GANJ DUNDWARA":"0","KASGANJ":"2721","PATIYALI":"0","SAHAWAR":"0","SIDHPURA":"3603","SORON":"2628","Total":"11970"},"3170":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KAUSHAMBI&district_code=3170&fin_year=2015-2016&Digest=fwjSQEvPcnKAALKsXB6xog","chail":"256","kara":"427","kaushambi":"768","manjhanpur":"1090","mooratganj":"0","Nevada":"4066","sarsawan":"2435","sirathu":"2318","Total":"11360"},"3128":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KHERI&district_code=3128&fin_year=2015-2016&Digest=xn4lgTpI1\\/Iafs4\\/\\/7kWTQ","BANKEYGANJ":"15468","BEHJAM":"0","BIJUA":"1329","DHAUREHRA":"1329","ISANAGAR":"3309","KUMBHIGOLA":"5516","LAKHIMPUR":"9518","MITAULI":"13944","MOHAMMADI":"1221","NAKAHA":"1912","NIGHASAN":"3125","PALIA":"3373","PASGAWAN":"0","PHOOLBEHAR":"5039","RAMIA BEHAR":"0","Total":"65083"},"3172":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KUSHI+NAGAR&district_code=3172&fin_year=2015-2016&Digest=KIos3qdC4R5n\\/tiHp0aghg","DUDHAHI":"167","fazilnagar":"602","hata":"2077","kaptainganj":"3249","kasaya":"1036","khadda":"346","motichak":"8232","nebua naurangia":"0","padrauna":"8666","ramkola":"0","seorahi":"0","sukrauli":"5613","tamkuhiraj":"0","vishunpura":"411","Total":"30399"},"3140":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=LALITPUR&district_code=3140&fin_year=2015-2016&Digest=dMHkvDN3Itf9gT5e0hIqww","BAR":"20277","BIRDHA":"20549","JAKHAURA":"31588","MADAWARA":"36330","MEHRAUNI":"37429","TALBEHAT":"20036","Total":"166209"},"3132":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=LUCKNOW&district_code=3132&fin_year=2015-2016&Digest=C9YNomBZGq\\/Js9JEB9c0bA","BAKSHI-KA-TALAB":"9122","CHINHAT":"528","GOSAIGANJ":"1712","KAKORI":"2179","MAL":"4107","MALIHABAD":"7437","MOHANLALGANJ":"2196","SAROJANINAGAR":"8993","Total":"36274"},"3152":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MAHARAJGANJ&district_code=3152&fin_year=2015-2016&Digest=sj0gR5cslIFPUQxBKUvraw","BRIDGEMANGANJ":"7153","DHANI":"91","GHUGHULI":"0","LAKSHMIPUR":"0","MAHRAJGANJ":"250","MITHAURA":"8348","NAUTANWA":"3095","NICHLAUL":"0","PANIYARA":"2244","PARTAWAL":"4647","PHARENDA":"372","SISWA":"0","Total":"26200"},"3179":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MAHOBA&district_code=3179&fin_year=2015-2016&Digest=7kAP6J7nbVr8wd9LChAbcw","CHARKHARI":"1894","JAITPUR":"14758","KABRAI":"2622","PANWARI":"4394","Total":"23668"},"3123":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MAINPURI&district_code=3123&fin_year=2015-2016&Digest=jxz213tlJXD2FrjYbOMJtQ","ALAO":"125","BARNAHAL":"314","BEWAR":"4863","GHIROR":"341","KARHAL":"4211","KISHNI":"226","KURAOLI":"1518","MAINPURI":"246","SULTANGANJ":"1444","Total":"13288"},"3119":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MATHURA&district_code=3119&fin_year=2015-2016&Digest=6xFJAV8hh4yBWUkb0HGPPw","BALDEO":"72","CHAUMUHA":"7159","CHHATA":"0","FARAH":"224","GOVARDHAN":"98","MAT":"412","MATHURA":"93","NANDGAON":"0","NOHJHIL":"28","RAYA":"0","Total":"8086"},"3156":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MAU&district_code=3156&fin_year=2015-2016&Digest=h7\\/IRYI1eT1ggifIDW1nrw","BADRAON":"5913","DOHRI GHAT":"3566","FATEHPUR MADAUN":"3659","GHOSI":"1781","KOPAGANJ":"864","MOHAMMADABAD GOHANA":"16382","PARDAHA":"986","RANIPUR":"1695","RATANPURA":"1667","Total":"36513"},"3115":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MEERUT&district_code=3115&fin_year=2015-2016&Digest=5+rxiDNJP9Bn3ZM37ZfsRA","DAURALA":"252","HASTINAPUR":"3293","JANIKHURD":"0","KHARKHODA":"172","MACHRA":"0","MAWANA KALAN":"0","MEERUT":"567","PARIKSHITGARH":"954","RAJPURA":"214","ROHTA":"486","SARDHANA":"0","SARURPUR KHURD":"0","Total":"5938"},"3162":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MIRZAPUR&district_code=3162&fin_year=2015-2016&Digest=KH7eaVtFteecWtLZ4Ahamw","CHHANVEY":"2567","CITY (NAGAR)":"5676","HALLIA":"6986","JAMALPUR":"2181","KON":"2595","LALGANJ":"3022","MAJHAWA":"0","NARAINPUR":"1849","PAHARI":"1133","PATEHRA KALA":"5835","RAJGARH":"11117","SHIKHAR":"413","Total":"43374"},"3110":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MORADABAD&district_code=3110&fin_year=2015-2016&Digest=7W94QjqLQXCEDeqXmMLlHg","BHAGATPUR TANDA":"7635","BILARI":"1843","CHHAJLET":"10372","DILARI":"4229","DINGARPUR":"630","MORADABAD":"1682","MUNDA PANDEY":"10808","THAKURDWARA":"2884","Total":"40083"},"3114":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MUZAFFARNAGAR&district_code=3114&fin_year=2015-2016&Digest=kMGvq9LRDZljIQI9vaMoqg","BAGHARA":"343","BUDHANA":"1634","CHARTHAWAL":"434","JANSATH":"1713","KHATAULI":"2850","MORNA":"70","MUZAFFARNAGAR":"507","PURKAJI":"422","SHAHPUR":"0","Total":"7973"},"3126":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=PILIBHIT&district_code=3126&fin_year=2015-2016&Digest=eacZIVYyYo5u8ItiEsFP9Q","AMARIYA":"4243","BARKHERA":"220","BILSANDA":"89","BISALPUR":"0","LALAURIKHERA":"0","MARORI":"3416","PURANPUR":"2737","Total":"10705"},"3144":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=PRATAPGARH&district_code=3144&fin_year=2015-2016&Digest=3IOQfAuGAY+s2fH19Z2t3Q","ASPUR DEOSARA":"1971","BABA BELKHARNATH DHAM":"1018","BABAGANJ":"5413","BIHAR":"9278","GAURA":"189","KALAKANKAR":"6126","KUNDA":"2956","LAKSHAMANPUR":"9171","LALGANJ":"1262","MAGRAURA":"6490","MANDHATA":"1895","PATTI":"2636","PRATAPGARH (SADAR)":"1167","RAMPUR SANRAMGARH":"1611","SANDWA CHANDRIKA":"35583","SANGIPUR":"14510","SHIVGARH":"1747","Total":"103023"},"3133":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=RAE+BARELI&district_code=3133&fin_year=2015-2016&Digest=CRvBbLlz\\/MtBEExCbAjs\\/g","AMAWAN":"7289","BACHHRAWAN":"17291","CHHATOH":"5173","DALMAU":"11566","DEENSHAH GAURA":"5855","DIH":"784","HARCHANDPUR":"3271","JAGATPUR":"7754","KHIRON":"2596","LALGANJ":"650","MAHRAJGANJ":"7208","RAHI":"5673","ROHANIA":"360","SALON":"3137","SARENI":"3963","SATAON":"9527","SHIVGARH":"6996","UNCHAHAR":"7441","Total":"106534"},"3111":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=RAMPUR&district_code=3111&fin_year=2015-2016&Digest=mIJY4Dms+BUISJYFPvzMjA","BILASPUR":"270","CHAMRAON":"2169","MILAK":"2294","SAIDNAGAR":"585","SHAHABAD":"3065","SUAR":"375","Total":"8758"},"3112":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SAHARANPUR&district_code=3112&fin_year=2015-2016&Digest=aFZ1f2CbV6GzQWpp3dUoJg","BALLIA KHERI":"1210","DEOBAND":"2012","GANGOH":"37","MUZAFFARABAD":"63","NAGAL":"2526","NAKUR":"2174","NANAUTA":"0","PUWARKA":"210","RAMPUR MANIHARAN":"132","SADAULI QADEEM":"50","SARSAWAN":"987","Total":"9401"},"3184":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SAMBHAL&district_code=3184&fin_year=2015-2016&Digest=GvkYcW3sqI9VwC1NFgqDzQ","ASMAULI":"12002","BAHJOI":"319","BANIYAKHERA":"1677","GUNNAUR":"0","JUNAWAI":"11409","PANWASA":"13668","RAJPURA":"0","SAMBHAL":"7793","Total":"46868"},"3174":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SANT+KABEER+NAGAR&district_code=3174&fin_year=2015-2016&Digest=PFKPk3aR+6vF\\/yDpFhJhrg","BAGHAULI":"2862","BELHAR KALA":"2786","HAISAR BAZAR":"828","KHALILABAD":"4546","MEHDAWAL":"2016","NATH NAGAR":"23377","PAULI":"16255","SANTHA":"3052","SEMARIYAWAN":"6996","Total":"62718"},"3173":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SANT+RAVIDAS+NAGAR&district_code=3173&fin_year=2015-2016&Digest=he+WnM4MonkdfEHj7l2+zg","ABHOLI":"5391","Aurai":"2281","BHADOHI":"10504","Deegh":"2187","Gyanpur":"5723","Suriyavan":"1498","Total":"27584"},"3127":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SHAHJAHANPUR&district_code=3127&fin_year=2015-2016&Digest=c2C9B5L\\/TH1bbtYmxCLu5A","BANDA":"1807","BHAWAL KHERA":"12219","DADROL":"7047","JAITPUR":"17705","JALALABAD":"7903","KALAN":"639","KANTH":"4113","KHUDAGANJ KATRA":"4816","KHUTAR":"1614","MADNAPUR":"7489","MIRZAPUR":"899","NIGOHI":"6687","POWAYAN":"4365","SINDHAULI":"3333","TILHAR":"14253","Total":"94889"},"3183":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SHAMLI&district_code=3183&fin_year=2015-2016&Digest=macK0Hjy5bvSlmGaZ3BDHg","KAIRANA":"234","KANDHLA":"0","SHAMLI":"323","THANA BHAWAN":"2884","UN":"538","Total":"3979"},"3176":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SHRAVASTI&district_code=3176&fin_year=2015-2016&Digest=\\/s34qzJzvDLIchb\\/K19PEw","EKONA":"466","GILAULA":"13509","HARIHARPUR RANI":"3773","JAMUNAHA":"2830","SIRSIYA":"4116","Total":"24694"},"3151":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SIDDHARTH+NAGAR&district_code=3151&fin_year=2015-2016&Digest=20mXKdlHbpcdy+KmePedzw","BANSI":"22614","BARHNI":"40360","BHANWAPUR":"13988","BIRDPUR":"32771","DOMARIYAGANJ":"18524","ITWA":"36392","JOGIA":"12906","KHESRAHA":"48065","KHUNIYAON":"18299","LOTAN":"26424","MITHWAL":"29874","NAUGARH":"32065","SHOHARATGARH":"18387","USKA BAZAR":"33534","Total":"384203"},"3129":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SITAPUR&district_code=3129&fin_year=2015-2016&Digest=u+ZVcHNC3ux1zufx7NZXWw","AILIYA":"10251","BEHTA":"30775","BISWAN":"40573","GONDLAMAU":"15258","HARGAON":"6497","KASMANDA":"18239","KHAIRABAD":"15801","LAHARPUR":"14138","MACHHREHTA":"11700","MAHMUDABAD":"13227","MAHOLI":"12411","MISRIKH":"14099","PAHALA":"9971","PARSENDI":"11099","PISAWAN":"21053","RAMPUR MATHURA":"3222","REUSA":"17818","SAKRAN":"22196","SIDHAULI":"10184","Total":"298512"},"3163":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SONBHADRA&district_code=3163&fin_year=2015-2016&Digest=gAL5a\\/1WWY6pR37Oz08oQg","BABHANI":"19206","CHATRA":"16114","CHOPAN":"9253","DUDHI":"8641","GHORAWAL":"9014","MYORPUR":"30680","NAGWA":"5379","ROBERTSGANJ":"7736","Total":"106023"},"3150":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SULTANPUR&district_code=3150&fin_year=2015-2016&Digest=Lb0Dftv59CbF4wdp9+v3Sg","AKHAND NAGAR":"869","BALDIRAI":"4001","BHADAIYA":"2490","DHANPATGANJ":"29309","DOSTPUR":"2443","DUBEPUR":"3622","JAISINGHPUR":"2700","KADIPUR":"6851","KARAUDI KALAN":"13741","KUREBHAR":"3531","KURWAR":"1138","LAMBHUA":"4461","MOTIGARPUR":"1011","P.P.Kamaicha":"1047","Total":"77214"},"3131":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=UNNAO&district_code=3131&fin_year=2015-2016&Digest=ywyUTDQiQ5Qbb17VY\\/v8ig","ASOHA":"14002","AURAS":"6755","BANGARMAU":"4166","BICHHIYA":"989","BIGHAPUR":"4843","FATEHPUR CHAURASI":"2836","GANJ MORADABAD":"3991","HASANGANJ":"9311","HILAULI":"3362","MIANGANJ":"4763","NAWABGANJ":"10440","PURWA":"3158","SAFIPUR":"7271","SIKANDARPUR KARAN":"3734","SIKANDARPUR SARAUSI":"3930","SUMERPUR":"7016","Total":"90567"},"3161":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=VARANASI&district_code=3161&fin_year=2015-2016&Digest=kzr4B6DvbVSIn8\\/iA2\\/ZhQ","Arajiline":"288","Baragaon":"599","Chiraigaon":"1306","Cholapur":"19075","Harahua":"0","Kashi Vidyapeeth":"2755","Pindra":"14146","Sevapuri":"1584","Total":"39753"},"Total":"4754075"}	1432272178	\N	1	\N
7	1	{"3120":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AGRA&district_code=3120&fin_year=2015-2016&Digest=tRM0SoS+7mCALrRloE5saw","ACHHNERA":{"5":"2478","4":"7112"},"AKOLA":{"5":"10101","4":"6977"},"BAH":{"5":"4718","4":"11378"},"BARAULI AHIR":{"5":"4151","4":"5209"},"BICHPURI":{"5":"3814","4":"3509"},"ETMADPUR":{"5":"4422","4":"5021"},"FATEHABAD":{"5":"2490","4":"38541"},"FATEHPUR SIKRI":{"5":"7484","4":"20629"},"JAGNER":{"5":"7752","4":"7389"},"JAITPUR KALAN":{"5":"1273","4":"9576"},"KHANDAULI":{"5":"3855","4":"6881"},"KHERAGARH":{"5":"323","4":"2872"},"PINAHAT":{"5":"1915","4":"6416"},"SAIYAN":{"5":"8785","4":"5876"},"SHAMSABAD":{"5":"2118","4":"13357"},"Total":{"5":"65679","4":"150743"}},"3118":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=ALIGARH&district_code=3118&fin_year=2015-2016&Digest=GXjVN5hve8A0WHOkCDOcig","AKRABAD":{"5":"655","4":"12753"},"ATRAULI":{"5":"757","4":"28673"},"BIJAULI":{"5":"1501","4":"17674"},"CHANDAUS":{"5":"58","4":"18514"},"DHANIPUR":{"5":"28","4":"10505"},"GANGIRI":{"5":"1006","4":"24432"},"GONDA":{"5":"3461","4":"9505"},"IGLAS":{"5":"98","4":"18381"},"JAWAN SIKANDERPUR":{"5":"775","4":"13722"},"KHAIR":{"5":"3359","4":"7068"},"LODHA":{"5":"1728","4":"13117"},"TAPPAL":{"5":"487","4":"20244"},"Total":{"5":"13913","4":"194588"}},"3145":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=ALLAHABAD&district_code=3145&fin_year=2015-2016&Digest=WGDHEw0EZqr+hfoQRd7hcg","BAHADURPUR":{"5":"833","4":"12332"},"BAHRIA":{"5":"2341","4":"28477"},"CHAKA":{"5":"374","4":"7486"},"DHANUPUR":{"5":"8229","4":"19146"},"HANDIA":{"5":"17374","4":"20312"},"HOLAGARH":{"5":"13682","4":"17230"},"JASRA":{"5":"3302","4":"19855"},"KARCHHANA":{"5":"5684","4":"24892"},"KAUDHIYARA":{"5":"1964","4":"14216"},"KAURIHAR":{"5":"16189","4":"23542"},"KORAON":{"5":"2364","4":"57850"},"MANDA":{"5":"14500","4":"28055"},"MAUAIMA":{"5":"2844","4":"21487"},"MEJA":{"5":"5217","4":"18721"},"PHULPUR":{"5":"677","4":"16912"},"PRATAPPUR":{"5":"5024","4":"12648"},"SAIDABAD":{"5":"1118","4":"6734"},"SHANKARGARH":{"5":"5880","4":"34072"},"SORAON":{"5":"2557","4":"12064"},"URUWAN":{"5":"10711","4":"11580"},"Total":{"5":"120864","4":"407611"}},"3178":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AMBEDKAR+NAGAR&district_code=3178&fin_year=2015-2016&Digest=6xCDtXIon9+woChHWRt+\\/Q","Akbarpur":{"5":"8628","4":"49767"},"Baskhari":{"5":"7189","4":"28603"},"BHITI":{"5":"9930","4":"23546"},"Bhiyawan":{"5":"22978","4":"27778"},"Jahangir Ganj":{"5":"2570","4":"27725"},"Jalal Pur":{"5":"26255","4":"25984"},"Katehari":{"5":"13541","4":"48461"},"Ram Nagar":{"5":"23689","4":"20010"},"Tanda":{"5":"29036","4":"35748"},"Total":{"5":"143816","4":"287622"}},"3181":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AMETHI&district_code=3181&fin_year=2015-2016&Digest=ZuycpaUonoDQBJ7iNfp\\/Rg","AMETHI":{"5":"1520","4":"11645"},"BAHADURPUR":{"5":"2619","4":"15757"},"BHADAR":{"5":"8884","4":"8485"},"BHETUA":{"5":"2607","4":"11391"},"GAURIGANJ":{"5":"3246","4":"33344"},"JAGDISHPUR":{"5":"16262","4":"30732"},"JAMO":{"5":"76954","4":"42498"},"MUSAFIR KHANA":{"5":"989","4":"36030"},"SANGRAMPUR":{"5":"702","4":"5738"},"SHAHGARH":{"5":"742","4":"26740"},"SHUKUL BAZAR":{"5":"6632","4":"18323"},"SINGHPUR":{"5":"29266","4":"43548"},"TILOI":{"5":"1748","4":"21121"},"Total":{"5":"152171","4":"305352"}},"3167":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AMROHA&district_code=3167&fin_year=2015-2016&Digest=iI+wtGgnbUaceHymdPOsfQ","AMROHA":{"5":"31150","4":"17324"},"DHANAURA":{"5":"8174","4":"13463"},"GAJRAULA":{"5":"25488","4":"15994"},"GANGESHWARI":{"5":"9909","4":"37948"},"HASANPUR":{"5":"18714","4":"41378"},"JOYA":{"5":"45331","4":"32052"},"Total":{"5":"138766","4":"158159"}},"3169":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AURAIYA&district_code=3169&fin_year=2015-2016&Digest=t5CDGH1EsNMxDO78ppMdHg","ACHCHALDA":{"5":"753","4":"28553"},"AJITMAL":{"5":"5540","4":"33328"},"AURAIYA":{"5":"6624","4":"23970"},"BHAGYANAGAR":{"5":"7275","4":"16705"},"BIDHUNA":{"5":"1786","4":"22008"},"ERWA KATRA":{"5":"6202","4":"12659"},"SAHAR":{"5":"952","4":"26337"},"Total":{"5":"29132","4":"163560"}},"3157":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=AZAMGARH&district_code=3157&fin_year=2015-2016&Digest=cCKbpgnS6n7Kl2UatV\\/4mQ","AHIRAULA":{"5":"8251","4":"15367"},"ATRAULIA":{"5":"0","4":"12531"},"AZMATGARH":{"5":"35724","4":"39465"},"BILARIYAGANJ":{"5":"5616","4":"65930"},"HARAIYA":{"5":"22653","4":"50585"},"JAHANAGANJ":{"5":"18276","4":"27379"},"KOILSA":{"5":"8288","4":"37120"},"LALGANJ":{"5":"14094","4":"15815"},"MAHRAJGANJ":{"5":"0","4":"19604"},"MARTINGANJ":{"5":"182","4":"11693"},"MEHNAGAR":{"5":"1218","4":"55520"},"MIRZAPUR":{"5":"4677","4":"12990"},"MOHAMMADPUR":{"5":"5984","4":"13900"},"PALHANA":{"5":"1428","4":"22563"},"PALHANI":{"5":"2588","4":"15538"},"PAWAI":{"5":"17081","4":"17520"},"PHULPUR":{"5":"2856","4":"20064"},"RANI KI SARAI":{"5":"1200","4":"7452"},"SATHIYAON":{"5":"766","4":"23053"},"TAHBARPUR":{"5":"7450","4":"21632"},"TARWA":{"5":"1791","4":"32827"},"THEKMA":{"5":"24420","4":"17237"},"Total":{"5":"184543","4":"555785"}},"3165":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BAGHPAT&district_code=3165&fin_year=2015-2016&Digest=LwvxUa8qfQ2DBZQhMV7gcQ","BAGHPAT":{"5":"262","4":"3116"},"BARAUT":{"5":"432","4":"2762"},"BINAULI":{"5":"120","4":"2543"},"CHHAPRAULI":{"5":"12","4":"1319"},"KHEKRA":{"5":"0","4":"1343"},"PILANA":{"5":"1124","4":"4882"},"Total":{"5":"1950","4":"15965"}},"3146":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BAHRAICH&district_code=3146&fin_year=2015-2016&Digest=8BLtdj5LDp+Bk24mQcZrVA","BALAHA":{"5":"2942","4":"32472"},"CHITAURA":{"5":"1930","4":"38539"},"HUZOORPUR":{"5":"1093","4":"70372"},"JARWAL":{"5":"5404","4":"42412"},"KAISARGANJ":{"5":"10634","4":"43261"},"MAHASI":{"5":"252","4":"44577"},"MIHINPURWA":{"5":"6538","4":"56869"},"NAWABGANJ":{"5":"2881","4":"31948"},"PHAKHARPUR":{"5":"13999","4":"56138"},"PRAYAGPUR":{"5":"4667","4":"31021"},"RISIA":{"5":"14381","4":"38805"},"SHIVPUR":{"5":"2495","4":"47244"},"TAJWAPUR":{"5":"8422","4":"42657"},"VISHESHWARGANJ":{"5":"9581","4":"28738"},"Total":{"5":"85219","4":"605053"}},"3159":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BALLIA&district_code=3159&fin_year=2015-2016&Digest=OMyuEI+dqcimT6Kfclq1JQ","Bairia":{"5":"192","4":"12597"},"Bansdih":{"5":"0","4":"25201"},"Belhari":{"5":"0","4":"7956"},"Beruarbari":{"5":"1047","4":"12393"},"CHILKAHAR":{"5":"2068","4":"16839"},"Dubhar":{"5":"0","4":"9399"},"Garwar":{"5":"0","4":"9324"},"Hanumanganj":{"5":"0","4":"9047"},"Maniar":{"5":"0","4":"32513"},"Murlichhapra":{"5":"0","4":"5426"},"NAGRA":{"5":"0","4":"22165"},"Navanagar":{"5":"0","4":"9145"},"Pandah":{"5":"0","4":"9995"},"Rasra":{"5":"0","4":"17059"},"Reoti":{"5":"0","4":"22408"},"SIAR":{"5":"10426","4":"17782"},"Sohanv":{"5":"11697","4":"14419"},"Total":{"5":"25430","4":"253668"}},"3175":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BALRAMPUR&district_code=3175&fin_year=2015-2016&Digest=EDPasx4UtQ7\\/Yx+YEei3QQ","BALRAMPUR":{"5":"3639","4":"47478"},"GAINDAS BUJURG":{"5":"235","4":"8484"},"GAISRI":{"5":"806","4":"46469"},"HARYA SATGHARWA":{"5":"2918","4":"46650"},"PACHPEDWA":{"5":"0","4":"32554"},"REHERA BAZAR":{"5":"4177","4":"45982"},"SHRIDUTTGANJ":{"5":"2101","4":"20449"},"TULSIPUR":{"5":"796","4":"37488"},"UTRAULA":{"5":"1533","4":"31030"},"Total":{"5":"16205","4":"316584"}},"3142":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BANDA&district_code=3142&fin_year=2015-2016&Digest=q42oZGdw\\/pHE9OSCnklbPg","BABERU":{"5":"23299","4":"60191"},"BADOKHAR KHURD":{"5":"15530","4":"39844"},"BISANDA":{"5":"12209","4":"44379"},"JASPURA":{"5":"2762","4":"13841"},"KAMASIN":{"5":"8294","4":"30445"},"MAHUVA":{"5":"16107","4":"62461"},"NARAINI":{"5":"31084","4":"71261"},"TINDWARI":{"5":"4036","4":"19400"},"Total":{"5":"113321","4":"341822"}},"3148":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BARABANKI&district_code=3148&fin_year=2015-2016&Digest=eqwk8kXjGe41V7LVDuZ1jQ","BANI KODAR":{"5":"6943","4":"39377"},"BANKI":{"5":"2199","4":"18229"},"DARIYABAD":{"5":"0","4":"49394"},"DEWA":{"5":"814","4":"18208"},"FATEHPUR":{"5":"10232","4":"23670"},"HAIDARGARH":{"5":"3679","4":"31992"},"HARAKH":{"5":"827","4":"9065"},"MASAULI":{"5":"117","4":"9580"},"NINDURA":{"5":"18473","4":"52324"},"PUREDALAI":{"5":"2390","4":"21317"},"RAMNAGAR":{"5":"2397","4":"30405"},"SIDDHAUR":{"5":"3902","4":"29450"},"SIRAULI GAUSPUR":{"5":"8222","4":"37413"},"SURATGANJ":{"5":"959","4":"18385"},"TRIVEDIGANJ":{"5":"2533","4":"22145"},"Total":{"5":"63687","4":"410954"}},"3125":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BAREILLY&district_code=3125&fin_year=2015-2016&Digest=HAGu+GqSWr+jgO7FWrY4Lg","AALAMPUR JAFARABAD":{"5":"2533","4":"10124"},"BAHERI":{"5":"391","4":"14172"},"BHADPURA":{"5":"5322","4":"11386"},"BHOJIPURA":{"5":"1826","4":"8367"},"BHUTA":{"5":"3881","4":"8916"},"BITHIRI CHAINPUR":{"5":"3256","4":"6602"},"FARIDPUR":{"5":"1387","4":"9948"},"FATEHGANJ WEST":{"5":"337","4":"7568"},"KYARA":{"5":"301","4":"9233"},"MAJHGAWAN":{"5":"1113","4":"13121"},"MIRGANJ":{"5":"196","4":"9341"},"NAWABGANJ":{"5":"7563","4":"12912"},"RAMNAGAR":{"5":"2569","4":"4644"},"RICHHA":{"5":"1710","4":"9767"},"SHERGARH":{"5":"3845","4":"12053"},"Total":{"5":"36230","4":"148154"}},"3153":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BASTI&district_code=3153&fin_year=2015-2016&Digest=kQJXXKeRQaxM2vf9zup1PA","BAHADURPUR":{"5":"7656","4":"45121"},"BANKATI":{"5":"44337","4":"55730"},"BASTI":{"5":"12221","4":"41199"},"DUBAULIYA":{"5":"1128","4":"37357"},"GAUR":{"5":"1080","4":"32626"},"HARRAIYA":{"5":"10332","4":"83625"},"KAPTANGANJ":{"5":"11331","4":"40591"},"KUDARAHA":{"5":"20145","4":"62215"},"PARAS RAMPUR":{"5":"13417","4":"41457"},"RAMNAGAR":{"5":"0","4":"28463"},"RUDAULI":{"5":"9992","4":"98303"},"SALTAUA GOPAL PUR":{"5":"12059","4":"65322"},"SAU GHAT":{"5":"688","4":"35750"},"VIKRAM JOT":{"5":"128","4":"48913"},"Total":{"5":"144514","4":"716672"}},"3109":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BIJNOR&district_code=3109&fin_year=2015-2016&Digest=+QrsBzXTft4PeQ2X3gCyzg","AFZALGARH":{"5":"10351","4":"18732"},"ALLAHPUR":{"5":"7417","4":"13889"},"BUDHANPUR SEOHARA":{"5":"7682","4":"15157"},"HALDAUR(KHARI JHALU)":{"5":"2511","4":"7129"},"JALILPUR":{"5":"13245","4":"13703"},"KIRATPUR":{"5":"1935","4":"11139"},"Kotwali":{"5":"10173","4":"27313"},"MOHAMMEDPUR DEOMAL":{"5":"632","4":"28504"},"NAJIBABAD":{"5":"15525","4":"24046"},"NEHTAUR":{"5":"3689","4":"29870"},"NOORPUR":{"5":"3883","4":"21489"},"Total":{"5":"77043","4":"210971"}},"3124":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BUDAUN&district_code=3124&fin_year=2015-2016&Digest=nSyjuvg1Oj5BbE\\/ZF372bg","AMBIAPUR":{"5":"2570","4":"6416"},"ASAFPUR":{"5":"4474","4":"7662"},"BISAULI":{"5":"3950","4":"8680"},"DATAGANJ":{"5":"130","4":"12133"},"DEHGAWAN":{"5":"2182","4":"15376"},"ISLAMNAGAR":{"5":"2730","4":"9783"},"JAGAT":{"5":"282","4":"8495"},"MION":{"5":"5492","4":"16427"},"QADAR CHOWK":{"5":"7598","4":"15168"},"SAHASWAN":{"5":"4790","4":"21863"},"SALARPUR":{"5":"1892","4":"12607"},"SAMRER":{"5":"1012","4":"16962"},"UJHANI":{"5":"1508","4":"21996"},"USAWAN":{"5":"680","4":"18456"},"WAZIRGANJ":{"5":"4627","4":"17234"},"Total":{"5":"43917","4":"209258"}},"3117":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=BULANDSHAHR&district_code=3117&fin_year=2015-2016&Digest=WShNy3QeuaRqaYJMghSlOg","AGAUTA":{"5":"900","4":"1347"},"ANUPSHAHR":{"5":"382","4":"1275"},"ARANIYA":{"5":"949","4":"2937"},"BHAWAN BAHADUR NAGAR":{"5":"512","4":"2204"},"BULANDSHAHR":{"5":"250","4":"2339"},"DANPUR":{"5":"566","4":"10153"},"DIBAI":{"5":"492","4":"5534"},"GULAOTHI":{"5":"98","4":"1047"},"JAHANGIRABAD":{"5":"981","4":"3964"},"KHURJA":{"5":"672","4":"3434"},"LAKHAOTHI":{"5":"755","4":"2548"},"PAHASU":{"5":"0","4":"5370"},"SHIKARPUR":{"5":"55","4":"4241"},"SIKANDRABAD":{"5":"2207","4":"7657"},"SYANA":{"5":"399","4":"2049"},"UNCHAGAON":{"5":"1669","4":"1701"},"Total":{"5":"10887","4":"57800"}},"3171":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=CHANDAULI&district_code=3171&fin_year=2015-2016&Digest=9taP8s6SuYwQDCeN0ZR6SA","Barhani":{"5":"6818","4":"14782"},"Chahniya   ":{"5":"897","4":"12299"},"Chakiya":{"5":"4265","4":"26324"},"Chandauli   ":{"5":"3027","4":"10500"},"Dhanapur":{"5":"3522","4":"12775"},"Naugarh    ":{"5":"8802","4":"22621"},"Niyamatabad       ":{"5":"9883","4":"15903"},"Sahabganj   ":{"5":"8533","4":"25532"},"Sakaldiha":{"5":"0","4":"24214"},"Total":{"5":"45747","4":"164950"}},"3177":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=CHITRAKOOT&district_code=3177&fin_year=2015-2016&Digest=QINqS+CgjKiV7hZa9kx2Eg","Karwi":{"5":"26976","4":"49601"},"MANIKPUR":{"5":"16555","4":"57316"},"Mau":{"5":"14271","4":"47022"},"PAHARI":{"5":"16776","4":"39302"},"RAMNAGAR":{"5":"5723","4":"18392"},"Total":{"5":"80301","4":"211633"}},"3155":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=DEORIA&district_code=3155&fin_year=2015-2016&Digest=FOj+W+IkpVE7Ri\\/A2M4hsg","BAITALPUR":{"5":"271","4":"26116"},"BANKATA":{"5":"151","4":"15917"},"BARHAJ":{"5":"5461","4":"16039"},"BHAGALPUR":{"5":"0","4":"20000"},"BHALUANI":{"5":"2386","4":"29042"},"BHATNI":{"5":"0","4":"350"},"BHATPAR RANI":{"5":"0","4":"15686"},"DEORIA SADAR":{"5":"1650","4":"25612"},"DESAI DEORIA":{"5":"30020","4":"17314"},"GAURI BAZAR":{"5":"0","4":"35059"},"LAR":{"5":"0","4":"19613"},"PATHARDEWA":{"5":"0","4":"13757"},"RAMPUR KARKHANA":{"5":"1771","4":"12202"},"RUDRAPUR":{"5":"2113","4":"22808"},"SALEMPUR":{"5":"380","4":"21871"},"TARKULWA":{"5":"8860","4":"15662"},"Total":{"5":"53063","4":"307048"}},"3122":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=ETAH&district_code=3122&fin_year=2015-2016&Digest=1H5CeZE8ykxBX\\/CYN3vrRw","ALIGANJ":{"5":"810","4":"20251"},"AWAGARH":{"5":"3388","4":"20493"},"JAITHARA":{"5":"0","4":"26967"},"JALESAR":{"5":"2128","4":"7991"},"MAREHRA":{"5":"468","4":"13088"},"NIDHAULI KALAN":{"5":"2417","4":"18944"},"SAKIT":{"5":"2738","4":"13226"},"SHITALPUR":{"5":"9564","4":"11972"},"Total":{"5":"21513","4":"132932"}},"3135":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=ETAWAH&district_code=3135&fin_year=2015-2016&Digest=vnOLmMAKrTqJAJ+9rqYifQ","BARHPURA":{"5":"4954","4":"12819"},"BASREHAR":{"5":"0","4":"13754"},"BHARTHANA":{"5":"0","4":"12333"},"CHAKARNAGAR":{"5":"1908","4":"11958"},"JASWANTNAGAR":{"5":"3845","4":"11195"},"MAHEWA":{"5":"0","4":"25558"},"SEFAI":{"5":"1200","4":"21161"},"TAKHA":{"5":"586","4":"9382"},"Total":{"5":"12493","4":"118160"}},"3149":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=FAIZABAD&district_code=3149&fin_year=2015-2016&Digest=BkB7wLUvbfEEV1\\/lMhxzIA","AMANIGANJ":{"5":"8219","4":"44595"},"BIKAPUR":{"5":"9171","4":"25020"},"HASTINGANJ":{"5":"5284","4":"27373"},"MASODHA":{"5":"1986","4":"34429"},"MAWAI":{"5":"10261","4":"34475"},"MAYA BAZAR":{"5":"7207","4":"32788"},"MILKIPUR":{"5":"22274","4":"34266"},"PURA BAZAR":{"5":"9461","4":"26440"},"Rudauli":{"5":"14431","4":"31058"},"SOHAWAL":{"5":"4928","4":"30969"},"TARUN":{"5":"4832","4":"33018"},"Total":{"5":"98054","4":"354431"}},"3134":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=FARRUKHABAD&district_code=3134&fin_year=2015-2016&Digest=4QAPUTdeSuSWtFLNVDlfqg","BARHPUR":{"5":"380","4":"7205"},"KAIMGANJ":{"5":"2489","4":"22878"},"KAMALGANJ":{"5":"936","4":"22500"},"MOHAMADABAD":{"5":"3559","4":"12293"},"NAWABGANJ":{"5":"328","4":"11932"},"RAJEPUR":{"5":"504","4":"26868"},"SHAMSABAD":{"5":"1718","4":"27765"},"Total":{"5":"9914","4":"131441"}},"3143":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=FATEHPUR&district_code=3143&fin_year=2015-2016&Digest=X1xqxyJzNafRf2R56ePTAg","AIRAYA":{"5":"347","4":"22579"},"AMAULI":{"5":"2585","4":"16559"},"ASODHAR":{"5":"2148","4":"19442"},"BAHUA":{"5":"0","4":"16264"},"BHITAURA":{"5":"3485","4":"30547"},"DEVMAI":{"5":"929","4":"8070"},"DHATA":{"5":"2155","4":"30061"},"HASWA":{"5":"579","4":"22795"},"HATHGAON":{"5":"6173","4":"19203"},"KHAJUHA":{"5":"1267","4":"20960"},"MALWAN":{"5":"1987","4":"8197"},"TELYANI":{"5":"1327","4":"33205"},"VIJAYIPUR":{"5":"2398","4":"13499"},"Total":{"5":"25380","4":"261381"}},"3121":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=FIROZABAD&district_code=3121&fin_year=2015-2016&Digest=SlMefVavEAp3wQPCwi9Zsg","ARAON":{"5":"5123","4":"8025"},"EKA":{"5":"1807","4":"13139"},"FIROZABAD":{"5":"1128","4":"8523"},"JASRANA":{"5":"2314","4":"13480"},"KHERGARH":{"5":"2972","4":"11185"},"MADANPUR":{"5":"2593","4":"9373"},"NARKHI":{"5":"11184","4":"8042"},"SHIKOHABAD":{"5":"2732","4":"11409"},"TUNDLA":{"5":"9858","4":"8386"},"Total":{"5":"39711","4":"91562"}},"3164":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GAUTAM+BUDDHA+NAGAR&district_code=3164&fin_year=2015-2016&Digest=EsPdUY7\\/8NuWxmAvaMCNEQ","Bisrakh":{"5":"0","4":"29"},"Dadri":{"5":"0","4":"3256"},"Dankaur":{"5":"0","4":"60"},"Jewar":{"5":"0","4":"932"},"Total":{"5":"0","4":"4277"}},"3116":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GHAZIABAD&district_code=3116&fin_year=2015-2016&Digest=L5HEoHozqXkaxAah2abefQ","BHOJPUR":{"5":"0","4":"2801"},"LONI":{"5":"0","4":"112"},"MURADNAGAR":{"5":"0","4":"1359"},"RAJAPUR":{"5":"0","4":"4946"},"Total":{"5":"0","4":"9218"}},"3160":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GHAZIPUR&district_code=3160&fin_year=2015-2016&Digest=P5v7DnUXAJnaajvr6eWE4A","BHADAURA":{"5":"260","4":"8064"},"BHANWARKOL":{"5":"412","4":"9811"},"DEVKALI":{"5":"0","4":"40345"},"GHAZIPUR":{"5":"0","4":"10747"},"JAKHANIA":{"5":"1426","4":"59730"},"KARANDA":{"5":"228","4":"7298"},"KASIMABAD":{"5":"0","4":"20494"},"MANIHARI":{"5":"0","4":"33880"},"MARDAH":{"5":"0","4":"32824"},"MOHAMMADABAD":{"5":"0","4":"21400"},"REVATIPUR":{"5":"0","4":"9117"},"SADAT":{"5":"1494","4":"71358"},"SAIDPUR":{"5":"0","4":"26191"},"VARACHAKWAR":{"5":"0","4":"25963"},"VIRNO":{"5":"1704","4":"16248"},"ZAMANIA":{"5":"0","4":"9899"},"Total":{"5":"5524","4":"403369"}},"3147":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GONDA&district_code=3147&fin_year=2015-2016&Digest=f7jNMcvW2lblcDlmOLsk0g","BABHANJOT":{"5":"0","4":"9626"},"BELSAR":{"5":"1803","4":"27277"},"CHHAPIA":{"5":"992","4":"28935"},"COLONELGANJ":{"5":"3485","4":"23296"},"HALDHARMAU":{"5":"11051","4":"33159"},"ITIATHOK":{"5":"0","4":"31036"},"JHANJHARI":{"5":"0","4":"42880"},"KATRA BAZAR":{"5":"480","4":"78518"},"MANKAPUR":{"5":"360","4":"27615"},"MUJEHANA":{"5":"282","4":"15964"},"NAWABGANJ":{"5":"5559","4":"24417"},"PANDRI KRIPAL":{"5":"31078","4":"65121"},"PARASPUR":{"5":"0","4":"19560"},"RUPAIDEEH":{"5":"2446","4":"56926"},"TARABGANJ":{"5":"0","4":"12289"},"WAZIRGANJ":{"5":"0","4":"27599"},"Total":{"5":"57536","4":"524218"}},"3154":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=GORAKHPUR&district_code=3154&fin_year=2015-2016&Digest=TtBqhRvifl9kl9ajhafFvQ","BANSGAON":{"5":"3482","4":"28565"},"BARHALGANJ":{"5":"3741","4":"28030"},"BELGHAT":{"5":"1572","4":"53053"},"BHATHAT":{"5":"10755","4":"40195"},"BRAHMPUR":{"5":"7133","4":"25437"},"CAMPIERGANJ":{"5":"4475","4":"43100"},"CHIRGAWAN":{"5":"1753","4":"10308"},"GAUGAHA":{"5":"8239","4":"38836"},"GOLA":{"5":"769","4":"34673"},"JANGAL KODIA":{"5":"853","4":"70026"},"KAURI RAM":{"5":"30","4":"17115"},"KHAJANI":{"5":"1960","4":"30465"},"KHORABAR":{"5":"2707","4":"22230"},"PALI":{"5":"148","4":"42289"},"PIPRAICH":{"5":"2505","4":"35960"},"PIPRAULI":{"5":"522","4":"20800"},"SAHJANAWA":{"5":"10840","4":"52488"},"SARDARNAGAR":{"5":"600","4":"42136"},"URUWA":{"5":"2898","4":"29782"},"Total":{"5":"64982","4":"665488"}},"3141":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=HAMIRPUR&district_code=3141&fin_year=2015-2016&Digest=OvxLReiC8NcWkDUz5VX2sw","GOHAND":{"5":"8610","4":"25834"},"KURARA":{"5":"13391","4":"12952"},"MAUDAHA":{"5":"16676","4":"28747"},"MUSKARA":{"5":"2055","4":"16101"},"RATH":{"5":"2341","4":"10869"},"SARILA":{"5":"13157","4":"15543"},"SUMERPUR":{"5":"8534","4":"13679"},"Total":{"5":"64764","4":"123725"}},"3182":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=HAPUR&district_code=3182&fin_year=2015-2016&Digest=kcy9EWYl5yihl9OHC7at5g","DHAULANA":{"5":"191","4":"1069"},"GARH MUKTESHWAR":{"5":"448","4":"3073"},"HAPUR":{"5":"220","4":"784"},"SIMBHAWALI":{"5":"342","4":"961"},"Total":{"5":"1201","4":"5887"}},"3130":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=HARDOI&district_code=3130&fin_year=2015-2016&Digest=gd49z0QD8bp9nbwqEF4nUA","AHRORI":{"5":"0","4":"46103"},"BAWAN":{"5":"1071","4":"53244"},"BEHADAR":{"5":"2626","4":"35626"},"BHARAWAN":{"5":"0","4":"25129"},"BHARKHANI":{"5":"5526","4":"47894"},"BILGRAM":{"5":"1035","4":"23718"},"HARIYAWAN":{"5":"6409","4":"40538"},"HARPALPUR":{"5":"0","4":"37812"},"KACHHAUNA":{"5":"334","4":"14147"},"KOTHWAN":{"5":"0","4":"24559"},"MADHOGANJ":{"5":"1947","4":"18325"},"MALLAWAN":{"5":"404","4":"11439"},"PIHANI":{"5":"2609","4":"46785"},"SANDI":{"5":"2966","4":"25358"},"SANDILA":{"5":"266","4":"26815"},"SHAHABAD":{"5":"31968","4":"67728"},"SURSA":{"5":"31994","4":"42513"},"TADIYAWAN":{"5":"705","4":"44041"},"TONDARPUR":{"5":"16946","4":"40994"},"Total":{"5":"106806","4":"672768"}},"3166":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=HATHRAS&district_code=3166&fin_year=2015-2016&Digest=PKmK9ZyUYJg8100Jzf8pRA","HASAYAN":{"5":"0","4":"13107"},"HATHRAS":{"5":"732","4":"5427"},"MURSAN":{"5":"1042","4":"7258"},"SADABAD":{"5":"1530","4":"4380"},"Sasni":{"5":"1061","4":"9999"},"SEHPAU":{"5":"8257","4":"4149"},"SIKANDRARAO":{"5":"0","4":"6876"},"Total":{"5":"12622","4":"51196"}},"3138":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=JALAUN&district_code=3138&fin_year=2015-2016&Digest=sOKzEhwdMaLzFrHoxHJWXw","DAKORE":{"5":"627","4":"19557"},"JALAUN":{"5":"4784","4":"23892"},"KADAURA":{"5":"11919","4":"27010"},"KONCH":{"5":"2833","4":"32333"},"KUTHAUND":{"5":"9024","4":"25430"},"MADHOGARH":{"5":"1841","4":"20859"},"MAHEVA":{"5":"21","4":"39136"},"NADIGAON":{"5":"1186","4":"31989"},"RAMPURA":{"5":"659","4":"16100"},"Total":{"5":"32894","4":"236306"}},"3158":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=JAUNPUR&district_code=3158&fin_year=2015-2016&Digest=4QMZTGSemHkKeFCc7v2a+g","BADLA PUR":{"5":"1606","4":"22326"},"BAKSHA":{"5":"996","4":"22587"},"BARASATHI":{"5":"22315","4":"31764"},"DHARMA PUR":{"5":"2173","4":"5640"},"DOBHI":{"5":"4728","4":"12225"},"JALAL PUR":{"5":"12956","4":"17419"},"KARANJA KALA":{"5":"8933","4":"14207"},"KERAKAT":{"5":"11697","4":"14429"},"KHUTHAN":{"5":"35113","4":"31838"},"MACHCHALI SHAHAR":{"5":"4630","4":"20126"},"MAHARAJ GANJ":{"5":"7391","4":"15917"},"MARIYAHU":{"5":"781","4":"27542"},"MUFTI GANJ":{"5":"11322","4":"16147"},"MUNGRA BADSHAH PUR":{"5":"3804","4":"20819"},"RAM NAGAR":{"5":"2403","4":"34434"},"RAM PUR":{"5":"19832","4":"35859"},"SHAH GANJ":{"5":"31275","4":"56707"},"SIKRARA":{"5":"1301","4":"7686"},"SIRKONI":{"5":"2549","4":"11438"},"SUITHA KALA":{"5":"7623","4":"33565"},"SUJAN GANJ":{"5":"5732","4":"19822"},"Total":{"5":"199160","4":"472497"}},"3139":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=JHANSI&district_code=3139&fin_year=2015-2016&Digest=pZwS80KG1fPS1DBPAM8Tew","BABINA":{"5":"5776","4":"23208"},"BADAGAON":{"5":"2344","4":"18671"},"BAMAUR":{"5":"9162","4":"77784"},"BANGRA":{"5":"101175","4":"54975"},"CHIRGAON":{"5":"5406","4":"41734"},"GURSARAI":{"5":"33442","4":"58171"},"MAURANIPUR":{"5":"23699","4":"51482"},"MOTH":{"5":"12275","4":"44188"},"Total":{"5":"193279","4":"370213"}},"3168":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KANNAUJ&district_code=3168&fin_year=2015-2016&Digest=Nh3HYATqzjsXGAtlW0pM\\/g","CHHIBRAMAU":{"5":"6632","4":"21854"},"Gugrapur":{"5":"2147","4":"3963"},"HASERAN":{"5":"2127","4":"19930"},"JALALABAD":{"5":"1346","4":"4455"},"KANNAUJ":{"5":"12192","4":"21146"},"SAURIKH":{"5":"800","4":"16184"},"TALGRAM":{"5":"11953","4":"14625"},"UMARDA":{"5":"9901","4":"39716"},"Total":{"5":"47098","4":"141873"}},"3136":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KANPUR+DEHAT&district_code=3136&fin_year=2015-2016&Digest=hIWMlZ2OJiSGwCEr55nUug","AKBARPUR":{"5":"3718","4":"12129"},"AMRODHA":{"5":"1296","4":"18325"},"DERAPUR":{"5":"1469","4":"13811"},"JHINJHAK":{"5":"2132","4":"14521"},"MAITHA":{"5":"820","4":"20783"},"MALASA":{"5":"654","4":"13473"},"RAJPUR":{"5":"2428","4":"11729"},"RASULABAD":{"5":"2132","4":"27290"},"SANDALPUR":{"5":"3640","4":"19214"},"SARBANKHERA":{"5":"3850","4":"12101"},"Total":{"5":"22139","4":"163376"}},"3137":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KANPUR+NAGAR&district_code=3137&fin_year=2015-2016&Digest=G7pG9UzX3GDzaTcLMNJ5Xg","BHITARGAON":{"5":"3408","4":"13799"},"BILHAUR":{"5":"21507","4":"11903"},"CHAUBEYPUR":{"5":"7158","4":"9547"},"GHATAMPUR":{"5":"10075","4":"18791"},"KAKWAN":{"5":"8901","4":"7067"},"KALYANPUR":{"5":"1531","4":"5953"},"PATARA":{"5":"2874","4":"15811"},"SARSOL":{"5":"7975","4":"10894"},"SHIVRAJPUR":{"5":"5529","4":"21479"},"VIDHUNU":{"5":"1806","4":"13087"},"Total":{"5":"70764","4":"128331"}},"3180":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KASHGANJ&district_code=3180&fin_year=2015-2016&Digest=vJJr\\/qG+DLqFBtBmapejOw","AMANPUR":{"5":"3018","4":"25950"},"GANJ DUNDWARA":{"5":"0","4":"19343"},"KASGANJ":{"5":"2721","4":"23956"},"PATIYALI":{"5":"0","4":"16771"},"SAHAWAR":{"5":"0","4":"17913"},"SIDHPURA":{"5":"3603","4":"15098"},"SORON":{"5":"2628","4":"16856"},"Total":{"5":"11970","4":"135887"}},"3170":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KAUSHAMBI&district_code=3170&fin_year=2015-2016&Digest=fwjSQEvPcnKAALKsXB6xog","chail":{"5":"256","4":"11722"},"kara":{"5":"427","4":"24043"},"kaushambi":{"5":"768","4":"24912"},"manjhanpur":{"5":"1090","4":"29064"},"mooratganj":{"5":"0","4":"10946"},"Nevada":{"5":"4066","4":"25400"},"sarsawan":{"5":"2435","4":"33616"},"sirathu":{"5":"2318","4":"35428"},"Total":{"5":"11360","4":"195131"}},"3128":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KHERI&district_code=3128&fin_year=2015-2016&Digest=xn4lgTpI1\\/Iafs4\\/\\/7kWTQ","BANKEYGANJ":{"5":"15468","4":"29524"},"BEHJAM":{"5":"0","4":"24164"},"BIJUA":{"5":"1329","4":"15914"},"DHAUREHRA":{"5":"1329","4":"8592"},"ISANAGAR":{"5":"3309","4":"28112"},"KUMBHIGOLA":{"5":"5516","4":"18757"},"LAKHIMPUR":{"5":"9518","4":"32777"},"MITAULI":{"5":"13944","4":"19327"},"MOHAMMADI":{"5":"1221","4":"17449"},"NAKAHA":{"5":"1912","4":"21715"},"NIGHASAN":{"5":"3125","4":"39168"},"PALIA":{"5":"3373","4":"41198"},"PASGAWAN":{"5":"0","4":"21559"},"PHOOLBEHAR":{"5":"5039","4":"16977"},"RAMIA BEHAR":{"5":"0","4":"39334"},"Total":{"5":"65083","4":"374567"}},"3172":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=KUSHI+NAGAR&district_code=3172&fin_year=2015-2016&Digest=KIos3qdC4R5n\\/tiHp0aghg","DUDHAHI":{"5":"167","4":"28695"},"fazilnagar":{"5":"602","4":"43329"},"hata":{"5":"2077","4":"57270"},"kaptainganj":{"5":"3249","4":"78264"},"kasaya":{"5":"1036","4":"11249"},"khadda":{"5":"346","4":"32405"},"motichak":{"5":"8232","4":"49172"},"nebua naurangia":{"5":"0","4":"33200"},"padrauna":{"5":"8666","4":"62014"},"ramkola":{"5":"0","4":"22381"},"seorahi":{"5":"0","4":"43260"},"sukrauli":{"5":"5613","4":"92167"},"tamkuhiraj":{"5":"0","4":"52464"},"vishunpura":{"5":"411","4":"39958"},"Total":{"5":"30399","4":"645828"}},"3140":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=LALITPUR&district_code=3140&fin_year=2015-2016&Digest=dMHkvDN3Itf9gT5e0hIqww","BAR":{"5":"20277","4":"64956"},"BIRDHA":{"5":"20549","4":"84139"},"JAKHAURA":{"5":"31588","4":"55872"},"MADAWARA":{"5":"36330","4":"42383"},"MEHRAUNI":{"5":"37429","4":"51465"},"TALBEHAT":{"5":"20036","4":"32069"},"Total":{"5":"166209","4":"330884"}},"3132":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=LUCKNOW&district_code=3132&fin_year=2015-2016&Digest=C9YNomBZGq\\/Js9JEB9c0bA","BAKSHI-KA-TALAB":{"5":"9122","4":"18296"},"CHINHAT":{"5":"528","4":"1800"},"GOSAIGANJ":{"5":"1712","4":"15144"},"KAKORI":{"5":"2179","4":"4790"},"MAL":{"5":"4107","4":"23914"},"MALIHABAD":{"5":"7437","4":"29689"},"MOHANLALGANJ":{"5":"2196","4":"33581"},"SAROJANINAGAR":{"5":"8993","4":"13392"},"Total":{"5":"36274","4":"140606"}},"3152":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MAHARAJGANJ&district_code=3152&fin_year=2015-2016&Digest=sj0gR5cslIFPUQxBKUvraw","BRIDGEMANGANJ":{"5":"7153","4":"42546"},"DHANI":{"5":"91","4":"13963"},"GHUGHULI":{"5":"0","4":"84854"},"LAKSHMIPUR":{"5":"0","4":"70467"},"MAHRAJGANJ":{"5":"250","4":"61956"},"MITHAURA":{"5":"8348","4":"103917"},"NAUTANWA":{"5":"3095","4":"27920"},"NICHLAUL":{"5":"0","4":"57918"},"PANIYARA":{"5":"2244","4":"53081"},"PARTAWAL":{"5":"4647","4":"68434"},"PHARENDA":{"5":"372","4":"65543"},"SISWA":{"5":"0","4":"66553"},"Total":{"5":"26200","4":"717152"}},"3179":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MAHOBA&district_code=3179&fin_year=2015-2016&Digest=7kAP6J7nbVr8wd9LChAbcw","CHARKHARI":{"5":"1894","4":"15296"},"JAITPUR":{"5":"14758","4":"28580"},"KABRAI":{"5":"2622","4":"19622"},"PANWARI":{"5":"4394","4":"16864"},"Total":{"5":"23668","4":"80362"}},"3123":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MAINPURI&district_code=3123&fin_year=2015-2016&Digest=jxz213tlJXD2FrjYbOMJtQ","ALAO":{"5":"125","4":"7085"},"BARNAHAL":{"5":"314","4":"8062"},"BEWAR":{"5":"4863","4":"15023"},"GHIROR":{"5":"341","4":"9868"},"KARHAL":{"5":"4211","4":"16858"},"KISHNI":{"5":"226","4":"12201"},"KURAOLI":{"5":"1518","4":"13157"},"MAINPURI":{"5":"246","4":"8070"},"SULTANGANJ":{"5":"1444","4":"8935"},"Total":{"5":"13288","4":"99259"}},"3119":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MATHURA&district_code=3119&fin_year=2015-2016&Digest=6xFJAV8hh4yBWUkb0HGPPw","BALDEO":{"5":"72","4":"7250"},"CHAUMUHA":{"5":"7159","4":"6866"},"CHHATA":{"5":"0","4":"11232"},"FARAH":{"5":"224","4":"6882"},"GOVARDHAN":{"5":"98","4":"4999"},"MAT":{"5":"412","4":"9951"},"MATHURA":{"5":"93","4":"12365"},"NANDGAON":{"5":"0","4":"5175"},"NOHJHIL":{"5":"28","4":"9607"},"RAYA":{"5":"0","4":"11661"},"Total":{"5":"8086","4":"85988"}},"3156":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MAU&district_code=3156&fin_year=2015-2016&Digest=h7\\/IRYI1eT1ggifIDW1nrw","BADRAON":{"5":"5913","4":"26036"},"DOHRI GHAT":{"5":"3566","4":"30363"},"FATEHPUR MADAUN":{"5":"3659","4":"44325"},"GHOSI":{"5":"1781","4":"20818"},"KOPAGANJ":{"5":"864","4":"30817"},"MOHAMMADABAD GOHANA":{"5":"16382","4":"44550"},"PARDAHA":{"5":"986","4":"23114"},"RANIPUR":{"5":"1695","4":"67889"},"RATANPURA":{"5":"1667","4":"30066"},"Total":{"5":"36513","4":"317978"}},"3115":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MEERUT&district_code=3115&fin_year=2015-2016&Digest=5+rxiDNJP9Bn3ZM37ZfsRA","DAURALA":{"5":"252","4":"1015"},"HASTINAPUR":{"5":"3293","4":"8444"},"JANIKHURD":{"5":"0","4":"1624"},"KHARKHODA":{"5":"172","4":"3470"},"MACHRA":{"5":"0","4":"1289"},"MAWANA KALAN":{"5":"0","4":"1752"},"MEERUT":{"5":"567","4":"1213"},"PARIKSHITGARH":{"5":"954","4":"3820"},"RAJPURA":{"5":"214","4":"796"},"ROHTA":{"5":"486","4":"1961"},"SARDHANA":{"5":"0","4":"1731"},"SARURPUR KHURD":{"5":"0","4":"2492"},"Total":{"5":"5938","4":"29607"}},"3162":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MIRZAPUR&district_code=3162&fin_year=2015-2016&Digest=KH7eaVtFteecWtLZ4Ahamw","CHHANVEY":{"5":"2567","4":"26022"},"CITY (NAGAR)":{"5":"5676","4":"26743"},"HALLIA":{"5":"6986","4":"41473"},"JAMALPUR":{"5":"2181","4":"22884"},"KON":{"5":"2595","4":"11690"},"LALGANJ":{"5":"3022","4":"21080"},"MAJHAWA":{"5":"0","4":"6009"},"NARAINPUR":{"5":"1849","4":"8931"},"PAHARI":{"5":"1133","4":"11825"},"PATEHRA KALA":{"5":"5835","4":"14133"},"RAJGARH":{"5":"11117","4":"31801"},"SHIKHAR":{"5":"413","4":"5625"},"Total":{"5":"43374","4":"228216"}},"3110":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MORADABAD&district_code=3110&fin_year=2015-2016&Digest=7W94QjqLQXCEDeqXmMLlHg","BHAGATPUR TANDA":{"5":"7635","4":"17059"},"BILARI":{"5":"1843","4":"27733"},"CHHAJLET":{"5":"10372","4":"19247"},"DILARI":{"5":"4229","4":"13876"},"DINGARPUR":{"5":"630","4":"69701"},"MORADABAD":{"5":"1682","4":"11294"},"MUNDA PANDEY":{"5":"10808","4":"22908"},"THAKURDWARA":{"5":"2884","4":"20894"},"Total":{"5":"40083","4":"202712"}},"3114":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=MUZAFFARNAGAR&district_code=3114&fin_year=2015-2016&Digest=kMGvq9LRDZljIQI9vaMoqg","BAGHARA":{"5":"343","4":"4056"},"BUDHANA":{"5":"1634","4":"5351"},"CHARTHAWAL":{"5":"434","4":"2717"},"JANSATH":{"5":"1713","4":"3746"},"KHATAULI":{"5":"2850","4":"4760"},"MORNA":{"5":"70","4":"5090"},"MUZAFFARNAGAR":{"5":"507","4":"4124"},"PURKAJI":{"5":"422","4":"2700"},"SHAHPUR":{"5":"0","4":"3553"},"Total":{"5":"7973","4":"36097"}},"3126":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=PILIBHIT&district_code=3126&fin_year=2015-2016&Digest=eacZIVYyYo5u8ItiEsFP9Q","AMARIYA":{"5":"4243","4":"35265"},"BARKHERA":{"5":"220","4":"22605"},"BILSANDA":{"5":"89","4":"35105"},"BISALPUR":{"5":"0","4":"27517"},"LALAURIKHERA":{"5":"0","4":"16091"},"MARORI":{"5":"3416","4":"24403"},"PURANPUR":{"5":"2737","4":"73774"},"Total":{"5":"10705","4":"234760"}},"3144":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=PRATAPGARH&district_code=3144&fin_year=2015-2016&Digest=3IOQfAuGAY+s2fH19Z2t3Q","ASPUR DEOSARA":{"5":"1971","4":"13776"},"BABA BELKHARNATH DHAM":{"5":"1018","4":"8127"},"BABAGANJ":{"5":"5413","4":"30484"},"BIHAR":{"5":"9278","4":"30446"},"GAURA":{"5":"189","4":"12450"},"KALAKANKAR":{"5":"6126","4":"20922"},"KUNDA":{"5":"2956","4":"22257"},"LAKSHAMANPUR":{"5":"9171","4":"14544"},"LALGANJ":{"5":"1262","4":"9912"},"MAGRAURA":{"5":"6490","4":"9001"},"MANDHATA":{"5":"1895","4":"20107"},"PATTI":{"5":"2636","4":"5344"},"PRATAPGARH (SADAR)":{"5":"1167","4":"10709"},"RAMPUR SANRAMGARH":{"5":"1611","4":"13717"},"SANDWA CHANDRIKA":{"5":"35583","4":"13592"},"SANGIPUR":{"5":"14510","4":"10882"},"SHIVGARH":{"5":"1747","4":"8857"},"Total":{"5":"103023","4":"255127"}},"3133":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=RAE+BARELI&district_code=3133&fin_year=2015-2016&Digest=CRvBbLlz\\/MtBEExCbAjs\\/g","AMAWAN":{"5":"7289","4":"13842"},"BACHHRAWAN":{"5":"17291","4":"33151"},"CHHATOH":{"5":"5173","4":"17228"},"DALMAU":{"5":"11566","4":"23252"},"DEENSHAH GAURA":{"5":"5855","4":"12893"},"DIH":{"5":"784","4":"23633"},"HARCHANDPUR":{"5":"3271","4":"16760"},"JAGATPUR":{"5":"7754","4":"20283"},"KHIRON":{"5":"2596","4":"20649"},"LALGANJ":{"5":"650","4":"13278"},"MAHRAJGANJ":{"5":"7208","4":"26764"},"RAHI":{"5":"5673","4":"15587"},"ROHANIA":{"5":"360","4":"20105"},"SALON":{"5":"3137","4":"46201"},"SARENI":{"5":"3963","4":"13734"},"SATAON":{"5":"9527","4":"10543"},"SHIVGARH":{"5":"6996","4":"13692"},"UNCHAHAR":{"5":"7441","4":"44055"},"Total":{"5":"106534","4":"385650"}},"3111":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=RAMPUR&district_code=3111&fin_year=2015-2016&Digest=mIJY4Dms+BUISJYFPvzMjA","BILASPUR":{"5":"270","4":"12384"},"CHAMRAON":{"5":"2169","4":"17273"},"MILAK":{"5":"2294","4":"33225"},"SAIDNAGAR":{"5":"585","4":"30688"},"SHAHABAD":{"5":"3065","4":"20941"},"SUAR":{"5":"375","4":"49239"},"Total":{"5":"8758","4":"163750"}},"3112":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SAHARANPUR&district_code=3112&fin_year=2015-2016&Digest=aFZ1f2CbV6GzQWpp3dUoJg","BALLIA KHERI":{"5":"1210","4":"6148"},"DEOBAND":{"5":"2012","4":"3377"},"GANGOH":{"5":"37","4":"8953"},"MUZAFFARABAD":{"5":"63","4":"7325"},"NAGAL":{"5":"2526","4":"5170"},"NAKUR":{"5":"2174","4":"8414"},"NANAUTA":{"5":"0","4":"5121"},"PUWARKA":{"5":"210","4":"146"},"RAMPUR MANIHARAN":{"5":"132","4":"6610"},"SADAULI QADEEM":{"5":"50","4":"4651"},"SARSAWAN":{"5":"987","4":"5169"},"Total":{"5":"9401","4":"61084"}},"3184":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SAMBHAL&district_code=3184&fin_year=2015-2016&Digest=GvkYcW3sqI9VwC1NFgqDzQ","ASMAULI":{"5":"12002","4":"26585"},"BAHJOI":{"5":"319","4":"16715"},"BANIYAKHERA":{"5":"1677","4":"25731"},"GUNNAUR":{"5":"0","4":"18326"},"JUNAWAI":{"5":"11409","4":"24443"},"PANWASA":{"5":"13668","4":"29263"},"RAJPURA":{"5":"0","4":"15665"},"SAMBHAL":{"5":"7793","4":"22884"},"Total":{"5":"46868","4":"179612"}},"3174":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SANT+KABEER+NAGAR&district_code=3174&fin_year=2015-2016&Digest=PFKPk3aR+6vF\\/yDpFhJhrg","BAGHAULI":{"5":"2862","4":"39338"},"BELHAR KALA":{"5":"2786","4":"26585"},"HAISAR BAZAR":{"5":"828","4":"40071"},"KHALILABAD":{"5":"4546","4":"26857"},"MEHDAWAL":{"5":"2016","4":"46634"},"NATH NAGAR":{"5":"23377","4":"58718"},"PAULI":{"5":"16255","4":"39497"},"SANTHA":{"5":"3052","4":"40332"},"SEMARIYAWAN":{"5":"6996","4":"20737"},"Total":{"5":"62718","4":"338769"}},"3173":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SANT+RAVIDAS+NAGAR&district_code=3173&fin_year=2015-2016&Digest=he+WnM4MonkdfEHj7l2+zg","ABHOLI":{"5":"5391","4":"9184"},"Aurai":{"5":"2281","4":"20734"},"BHADOHI":{"5":"10504","4":"26861"},"Deegh":{"5":"2187","4":"15105"},"Gyanpur":{"5":"5723","4":"18356"},"Suriyavan":{"5":"1498","4":"13386"},"Total":{"5":"27584","4":"103626"}},"3127":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SHAHJAHANPUR&district_code=3127&fin_year=2015-2016&Digest=c2C9B5L\\/TH1bbtYmxCLu5A","BANDA":{"5":"1807","4":"23628"},"BHAWAL KHERA":{"5":"12219","4":"19208"},"DADROL":{"5":"7047","4":"11281"},"JAITPUR":{"5":"17705","4":"37076"},"JALALABAD":{"5":"7903","4":"17162"},"KALAN":{"5":"639","4":"10574"},"KANTH":{"5":"4113","4":"9921"},"KHUDAGANJ KATRA":{"5":"4816","4":"21186"},"KHUTAR":{"5":"1614","4":"19939"},"MADNAPUR":{"5":"7489","4":"11599"},"MIRZAPUR":{"5":"899","4":"8105"},"NIGOHI":{"5":"6687","4":"24327"},"POWAYAN":{"5":"4365","4":"27469"},"SINDHAULI":{"5":"3333","4":"23315"},"TILHAR":{"5":"14253","4":"24945"},"Total":{"5":"94889","4":"289735"}},"3183":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SHAMLI&district_code=3183&fin_year=2015-2016&Digest=macK0Hjy5bvSlmGaZ3BDHg","KAIRANA":{"5":"234","4":"4013"},"KANDHLA":{"5":"0","4":"2749"},"SHAMLI":{"5":"323","4":"4012"},"THANA BHAWAN":{"5":"2884","4":"6596"},"UN":{"5":"538","4":"6181"},"Total":{"5":"3979","4":"23551"}},"3176":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SHRAVASTI&district_code=3176&fin_year=2015-2016&Digest=\\/s34qzJzvDLIchb\\/K19PEw","EKONA":{"5":"466","4":"27408"},"GILAULA":{"5":"13509","4":"32621"},"HARIHARPUR RANI":{"5":"3773","4":"38069"},"JAMUNAHA":{"5":"2830","4":"23636"},"SIRSIYA":{"5":"4116","4":"33454"},"Total":{"5":"24694","4":"155188"}},"3151":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SIDDHARTH+NAGAR&district_code=3151&fin_year=2015-2016&Digest=20mXKdlHbpcdy+KmePedzw","BANSI":{"5":"22614","4":"65931"},"BARHNI":{"5":"40360","4":"92893"},"BHANWAPUR":{"5":"13988","4":"64169"},"BIRDPUR":{"5":"32771","4":"58636"},"DOMARIYAGANJ":{"5":"18524","4":"91031"},"ITWA":{"5":"36392","4":"45025"},"JOGIA":{"5":"12906","4":"42874"},"KHESRAHA":{"5":"48065","4":"106232"},"KHUNIYAON":{"5":"18299","4":"80447"},"LOTAN":{"5":"26424","4":"68456"},"MITHWAL":{"5":"29874","4":"42617"},"NAUGARH":{"5":"32065","4":"69505"},"SHOHARATGARH":{"5":"18387","4":"74208"},"USKA BAZAR":{"5":"33534","4":"47316"},"Total":{"5":"384203","4":"949340"}},"3129":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SITAPUR&district_code=3129&fin_year=2015-2016&Digest=u+ZVcHNC3ux1zufx7NZXWw","AILIYA":{"5":"10251","4":"25708"},"BEHTA":{"5":"30775","4":"41470"},"BISWAN":{"5":"40573","4":"40214"},"GONDLAMAU":{"5":"15258","4":"22149"},"HARGAON":{"5":"6497","4":"25388"},"KASMANDA":{"5":"18239","4":"28311"},"KHAIRABAD":{"5":"15801","4":"16871"},"LAHARPUR":{"5":"14138","4":"53132"},"MACHHREHTA":{"5":"11700","4":"16716"},"MAHMUDABAD":{"5":"13227","4":"57802"},"MAHOLI":{"5":"12411","4":"26009"},"MISRIKH":{"5":"14099","4":"31096"},"PAHALA":{"5":"9971","4":"37119"},"PARSENDI":{"5":"11099","4":"31084"},"PISAWAN":{"5":"21053","4":"28310"},"RAMPUR MATHURA":{"5":"3222","4":"62303"},"REUSA":{"5":"17818","4":"37976"},"SAKRAN":{"5":"22196","4":"45438"},"SIDHAULI":{"5":"10184","4":"23956"},"Total":{"5":"298512","4":"651052"}},"3163":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SONBHADRA&district_code=3163&fin_year=2015-2016&Digest=gAL5a\\/1WWY6pR37Oz08oQg","BABHANI":{"5":"19206","4":"31466"},"CHATRA":{"5":"16114","4":"40077"},"CHOPAN":{"5":"9253","4":"94642"},"DUDHI":{"5":"8641","4":"10554"},"GHORAWAL":{"5":"9014","4":"72446"},"MYORPUR":{"5":"30680","4":"46248"},"NAGWA":{"5":"5379","4":"27409"},"ROBERTSGANJ":{"5":"7736","4":"46958"},"Total":{"5":"106023","4":"369800"}},"3150":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=SULTANPUR&district_code=3150&fin_year=2015-2016&Digest=Lb0Dftv59CbF4wdp9+v3Sg","AKHAND NAGAR":{"5":"869","4":"22700"},"BALDIRAI":{"5":"4001","4":"15583"},"BHADAIYA":{"5":"2490","4":"11553"},"DHANPATGANJ":{"5":"29309","4":"37128"},"DOSTPUR":{"5":"2443","4":"17587"},"DUBEPUR":{"5":"3622","4":"9217"},"JAISINGHPUR":{"5":"2700","4":"30887"},"KADIPUR":{"5":"6851","4":"15667"},"KARAUDI KALAN":{"5":"13741","4":"11818"},"KUREBHAR":{"5":"3531","4":"20600"},"KURWAR":{"5":"1138","4":"20276"},"LAMBHUA":{"5":"4461","4":"20425"},"MOTIGARPUR":{"5":"1011","4":"22648"},"P.P.Kamaicha":{"5":"1047","4":"12568"},"Total":{"5":"77214","4":"268657"}},"3131":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=UNNAO&district_code=3131&fin_year=2015-2016&Digest=ywyUTDQiQ5Qbb17VY\\/v8ig","ASOHA":{"5":"14002","4":"34359"},"AURAS":{"5":"6755","4":"31933"},"BANGARMAU":{"5":"4166","4":"28349"},"BICHHIYA":{"5":"989","4":"14893"},"BIGHAPUR":{"5":"4843","4":"18192"},"FATEHPUR CHAURASI":{"5":"2836","4":"24982"},"GANJ MORADABAD":{"5":"3991","4":"18673"},"HASANGANJ":{"5":"9311","4":"27313"},"HILAULI":{"5":"3362","4":"25193"},"MIANGANJ":{"5":"4763","4":"32608"},"NAWABGANJ":{"5":"10440","4":"59144"},"PURWA":{"5":"3158","4":"20886"},"SAFIPUR":{"5":"7271","4":"31272"},"SIKANDARPUR KARAN":{"5":"3734","4":"18088"},"SIKANDARPUR SARAUSI":{"5":"3930","4":"17538"},"SUMERPUR":{"5":"7016","4":"24517"},"Total":{"5":"90567","4":"427940"}},"3161":{"link":"http:\\/\\/164.100.129.6\\/\\/netnrega\\/projected_VS_generated.aspx?file1=empprov&page1=d&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&district_name=VARANASI&district_code=3161&fin_year=2015-2016&Digest=kzr4B6DvbVSIn8\\/iA2\\/ZhQ","Arajiline":{"5":"288","4":"34440"},"Baragaon":{"5":"599","4":"14157"},"Chiraigaon":{"5":"1306","4":"7142"},"Cholapur":{"5":"19075","4":"20079"},"Harahua":{"5":"0","4":"280"},"Kashi Vidyapeeth":{"5":"2755","4":"10748"},"Pindra":{"5":"14146","4":"28849"},"Sevapuri":{"5":"1584","4":"30849"},"Total":{"5":"39753","4":"146544"}},"Total":{"5":"4754075","4":"19881060"}}	1432276500	\N	1	\N
\.


--
-- Name: parameter_parse_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('parameter_parse_id_seq', 7, true);


--
-- Data for Name: parameter_target; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY parameter_target (id, parameter_id, district_id, parameter_target, month) FROM stdin;
\.


--
-- Name: parameter_target_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('parameter_target_id_seq', 1, false);


--
-- Data for Name: parameter_value; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY parameter_value (id, parameter_id, district_id, parameter_value, update_time) FROM stdin;
1	1	3149	27.665187300208	1432248193
2	1	3111	5.3483969465649	1432248193
3	1	3145	29.651800368489	1432248193
4	1	3167	87.738288684172	1432248193
5	1	3172	4.706980806035	1432248193
6	1	3136	13.55094995593	1432248193
7	1	3118	7.1499784159352	1432248193
8	1	3142	33.152049897315	1432248193
9	1	3162	19.005678830582	1432248193
10	1	3179	29.451730917598	1432248193
11	1	3126	4.5599761458511	1432248193
12	1	3147	10.975586492642	1432248193
13	1	3159	10.024914455115	1432248193
14	1	3180	8.8087896561113	1432248193
15	1	3109	36.518289243545	1432248193
16	1	3124	20.987011249271	1432248193
17	1	3181	49.834617097645	1432248193
18	1	3116	0	1432248193
19	1	3128	17.375529611525	1432248193
20	1	3141	52.345120226308	1432248193
21	1	3148	15.497354935102	1432248193
22	1	3169	17.811200782587	1432248193
23	1	3119	9.4036377168907	1432248193
24	1	3132	25.798330085487	1432248193
25	1	3131	21.163480861803	1432248193
26	1	3164	0	1432248193
27	1	3184	26.094024898114	1432248193
28	1	3134	7.5425476069111	1432248193
29	1	3168	33.197296173338	1432248193
30	1	3135	10.572951929587	1432248193
31	1	3171	27.733858745074	1432248193
32	1	3163	28.670362358031	1432248193
33	1	3143	9.7099636163302	1432248193
34	1	3176	15.912312807691	1432248193
35	1	3182	20.400883302191	1432248193
36	1	3127	32.750271800093	1432248193
37	1	3133	27.624530014262	1432248193
38	1	3157	33.204026736958	1432248193
39	1	3120	43.57018236336	1432248193
40	1	3144	40.381065116589	1432248193
41	1	3117	18.835640138408	1432248193
42	1	3125	24.45428405578	1432248193
43	1	3183	16.895248609401	1432248193
44	1	3174	18.513500349796	1432248193
45	1	3170	5.8217300172704	1432248193
46	1	3154	9.7645637487077	1432248193
47	1	3166	24.654269864833	1432248193
48	1	3112	15.3902822343	1432248193
49	1	3178	50.001738392752	1432248193
50	1	3115	20.056067821799	1432248193
51	1	3175	5.1187046723776	1432248193
52	1	3177	37.943515425288	1432248193
53	1	3161	27.127006223387	1432248193
54	1	3121	43.370612262729	1432248193
55	1	3140	50.231803290579	1432248193
56	1	3146	14.084551270715	1432248193
57	1	3150	28.740736329223	1432248193
58	1	3138	13.920086667287	1432248193
59	1	3155	17.281662801907	1432248193
60	1	3129	45.850715457444	1432248193
61	1	3158	42.150532172691	1432248193
62	1	3123	13.387199145669	1432248193
63	1	3151	40.470537426001	1432248193
64	1	3156	11.48286988408	1432248193
65	1	3114	22.087708119788	1432248193
66	1	3139	52.207512972262	1432248193
67	1	3173	26.6188022311	1432248193
68	1	3152	3.6533398777386	1432248193
69	1	3130	15.875606449772	1432248193
70	1	3153	20.164594123951	1432248193
71	1	3122	16.183462221286	1432248193
72	1	3137	55.14178179863	1432248193
73	1	3110	19.773373061289	1432248193
74	1	3160	1.3694656753494	1432248193
75	1	3165	12.214218603194	1432248193
\.


--
-- Name: parameter_value_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('parameter_value_id_seq', 75, true);


--
-- Data for Name: request; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY request (id, request_type_id, request_subject, content, attachments, author_id, create_time, update_time) FROM stdin;
\.


--
-- Name: request_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('request_id_seq', 1, false);


--
-- Data for Name: request_type; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY request_type (id, category, name) FROM stdin;
1	0	Approval of Digital Certificate
\.


--
-- Name: request_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('request_type_id_seq', 1, true);


--
-- Data for Name: scheme; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY scheme (id, code, name_hi, name_en, description, finyear, documents, noofworks, totalcost) FROM stdin;
\.


--
-- Name: scheme_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('scheme_id_seq', 1, false);


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY "user" (id, username, auth_key, password_hash, password_reset_token, email, status, created_at, updated_at) FROM stdin;
1	admin	\N	$2y$13$yHU8EfZngEb9uUCpyto0GOBwnuOcS42xRPUJaMwZRO0KcxJ32ItMK	\N	\N	10	1431962015	1431962015
\.


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('user_id_seq', 1, true);


--
-- Data for Name: village; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY village (district_code, block_code, code, name_hi, name_en, census_code) FROM stdin;
\.


--
-- Data for Name: websitemanagement; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY websitemanagement (id, name_hi, name_en) FROM stdin;
1	Web Manager	Web Manager
\.


--
-- Name: websitemanagement_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('websitemanagement_id_seq', 1, true);


--
-- Data for Name: work; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY work (id, workid, name_hi, name_en, description, agency_id, work_type_id, totvalue, scheme_id, district_id, address, gpslat, gpslong, work_admin, block_code, panchayat_code, village_code, status, remarks, created_at, updated_at) FROM stdin;
\.


--
-- Name: work_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('work_id_seq', 1, false);


--
-- Data for Name: work_progress; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY work_progress (id, work_id, exp, phy, fin) FROM stdin;
\.


--
-- Name: work_progress_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('work_progress_id_seq', 1, false);


--
-- Data for Name: work_type; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY work_type (id, code, name_hi, name_en) FROM stdin;
\.


--
-- Name: work_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('work_type_id_seq', 1, false);


--
-- Name: agency_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY agency
    ADD CONSTRAINT agency_pkey PRIMARY KEY (id);


--
-- Name: authassignment_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY authassignment
    ADD CONSTRAINT authassignment_pkey PRIMARY KEY (item_name, user_id);


--
-- Name: authitem_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY authitem
    ADD CONSTRAINT authitem_pkey PRIMARY KEY (name);


--
-- Name: authitemchild_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY authitemchild
    ADD CONSTRAINT authitemchild_pkey PRIMARY KEY (parent, child);


--
-- Name: authrule_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY authrule
    ADD CONSTRAINT authrule_pkey PRIMARY KEY (name);


--
-- Name: block_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY block
    ADD CONSTRAINT block_pkey PRIMARY KEY (block_code);


--
-- Name: department_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY department
    ADD CONSTRAINT department_pkey PRIMARY KEY (id);


--
-- Name: designation_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY designation
    ADD CONSTRAINT designation_pkey PRIMARY KEY (id);


--
-- Name: designation_type_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY designation_type
    ADD CONSTRAINT designation_type_pkey PRIMARY KEY (id);


--
-- Name: district_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY district
    ADD CONSTRAINT district_pkey PRIMARY KEY (district_code);


--
-- Name: level_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY level
    ADD CONSTRAINT level_pkey PRIMARY KEY (id);


--
-- Name: marking_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY marking
    ADD CONSTRAINT marking_pkey PRIMARY KEY (id);


--
-- Name: migration_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY migration
    ADD CONSTRAINT migration_pkey PRIMARY KEY (version);


--
-- Name: panchayat_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY panchayat
    ADD CONSTRAINT panchayat_pkey PRIMARY KEY (code);


--
-- Name: parameter_parse_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY parameter_parse
    ADD CONSTRAINT parameter_parse_pkey PRIMARY KEY (id);


--
-- Name: parameter_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY parameter
    ADD CONSTRAINT parameter_pkey PRIMARY KEY (id);


--
-- Name: parameter_target_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY parameter_target
    ADD CONSTRAINT parameter_target_pkey PRIMARY KEY (id);


--
-- Name: parameter_value_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY parameter_value
    ADD CONSTRAINT parameter_value_pkey PRIMARY KEY (id);


--
-- Name: request_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY request
    ADD CONSTRAINT request_pkey PRIMARY KEY (id);


--
-- Name: request_type_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY request_type
    ADD CONSTRAINT request_type_pkey PRIMARY KEY (id);


--
-- Name: scheme_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY scheme
    ADD CONSTRAINT scheme_pkey PRIMARY KEY (id);


--
-- Name: user_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY "user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: village_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY village
    ADD CONSTRAINT village_pkey PRIMARY KEY (code);


--
-- Name: websitemanagement_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY websitemanagement
    ADD CONSTRAINT websitemanagement_pkey PRIMARY KEY (id);


--
-- Name: work_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY work
    ADD CONSTRAINT work_pkey PRIMARY KEY (id);


--
-- Name: work_progress_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY work_progress
    ADD CONSTRAINT work_progress_pkey PRIMARY KEY (id);


--
-- Name: work_type_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY work_type
    ADD CONSTRAINT work_type_pkey PRIMARY KEY (id);


--
-- Name: idx-auth_item-type; Type: INDEX; Schema: public; Owner: mac; Tablespace: 
--

CREATE INDEX "idx-auth_item-type" ON authitem USING btree (type);


--
-- Name: authassignment_item_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY authassignment
    ADD CONSTRAINT authassignment_item_name_fkey FOREIGN KEY (item_name) REFERENCES authitem(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: authitem_rule_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY authitem
    ADD CONSTRAINT authitem_rule_name_fkey FOREIGN KEY (rule_name) REFERENCES authrule(name) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: authitemchild_child_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY authitemchild
    ADD CONSTRAINT authitemchild_child_fkey FOREIGN KEY (child) REFERENCES authitem(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: authitemchild_parent_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY authitemchild
    ADD CONSTRAINT authitemchild_parent_fkey FOREIGN KEY (parent) REFERENCES authitem(name) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: designation_designation_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY designation
    ADD CONSTRAINT designation_designation_type_fkey FOREIGN KEY (designation_type_id) REFERENCES designation_type(id);


--
-- Name: designation_type_level_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY designation_type
    ADD CONSTRAINT designation_type_level_fkey FOREIGN KEY (level_id) REFERENCES level(id);


--
-- Name: level_department_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY level
    ADD CONSTRAINT level_department_fkey FOREIGN KEY (dept_id) REFERENCES department(id);


--
-- Name: parameter_parse_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY parameter_parse
    ADD CONSTRAINT parameter_parse_fkey FOREIGN KEY (parameter_id) REFERENCES parameter(id);


--
-- Name: parameter_target_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY parameter_target
    ADD CONSTRAINT parameter_target_fkey FOREIGN KEY (parameter_id) REFERENCES parameter(id);


--
-- Name: parameter_value_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY parameter_value
    ADD CONSTRAINT parameter_value_fkey FOREIGN KEY (parameter_id) REFERENCES parameter(id);


--
-- Name: request_marking_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY marking
    ADD CONSTRAINT request_marking_fkey FOREIGN KEY (request_id) REFERENCES request(id);


--
-- Name: request_request_type; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY request
    ADD CONSTRAINT request_request_type FOREIGN KEY (request_type_id) REFERENCES request_type(id);


--
-- Name: work_agency_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY work
    ADD CONSTRAINT work_agency_fkey FOREIGN KEY (agency_id) REFERENCES agency(id);


--
-- Name: work_scheme_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY work
    ADD CONSTRAINT work_scheme_fkey FOREIGN KEY (scheme_id) REFERENCES scheme(id);


--
-- Name: work_village_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY work
    ADD CONSTRAINT work_village_fkey FOREIGN KEY (village_code) REFERENCES village(code);


--
-- Name: work_work_type_fkey; Type: FK CONSTRAINT; Schema: public; Owner: mac
--

ALTER TABLE ONLY work
    ADD CONSTRAINT work_work_type_fkey FOREIGN KEY (work_type_id) REFERENCES work_type(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: mac
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM mac;
GRANT ALL ON SCHEMA public TO mac;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

