--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

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
    unit character varying(255),
    periodicity integer DEFAULT 1
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
-- Name: id; Type: DEFAULT; Schema: public; Owner: mac
--

ALTER TABLE ONLY parameter ALTER COLUMN id SET DEFAULT nextval('parameter_id_seq'::regclass);


--
-- Data for Name: parameter; Type: TABLE DATA; Schema: public; Owner: mac
--

COPY parameter (id, type, link, parser, name_hi, name_en, shortcode, description, weight, unit, periodicity) FROM stdin;
1	0	http://164.100.129.6/netnrega/projected_VS_generated.aspx?file1=empprov&page1=s&lflag=eng&state_name=UTTAR+PRADESH&state_code=31&fin_year=2015-2016&Digest=CgyzEo8dpRYpwcFbitdqJg	\N	रोज़गार 	Persondays (Monthwise)	mandays		10	No	1
5	1	http://164.100.129.6/netnrega/Citizen_html/stworkreptemp_n.aspx?lflag=eng&page=s&state_name=UTTAR+PRADESH&state_code=31&fin_year=2015-2016&Digest=BV7khWYyy5Hk0B1kh6+1gA	\N	कार्य श्रेणी 	Work Category	workcategory		8	Rs lakhs	1
6	1	http://164.100.129.6/netnrega/sec_sub_work_category.aspx?state_code=31&page=B&rcode=B&rsubcode=4&rsec_code=W09&fin_year=2015-2016&block_code=3120002&state_name=UTTAR%20PRADESH&district_name=AGRA&block_name=ACHHNERA	\N	कार्य श्रेणी उप श्रेणी 	work category sub category 	subcat		7	no	1
8	1	http://164.100.129.6/netnrega/sec_master_work_cat_work_pd.aspx?state_code=31&page=B&rcode=W01&fin_year=2015-2016&block_code=3120002&state_name=UTTAR%20PRADESH&district_name=AGRA&block_name=ACHHNERA	\N	जल सरंक्षण कार्य 	Water Conservation Works	water		8	no	1
4	1	http://localhost/basicmnrega/web/images/page3.html	\N	test	test	mandays	test	10	test	1
9	\N	http://localhost/basicmnrega/web/index.php/mnrega/default/genpage?cat=housing&level=0	\N	कार्य श्रेणी जिले वार 	work categories district wise	houses		5	No	1
10	0	http://localhost/basicmnrega/web/index.php/mnrega/default/genpage?cat=housing&level=1	\N	कार्य श्रेणी ब्लॉक वॉर 	Work categories Block wise	houses		5	No	1
11	1	http://164.100.129.4/netnrega/writereaddata/state_out/Empstatusall31_local_1516_.html	\N	रोज़गार की जानकारी 	Employment status 	empstatus		5	No	1
3	1	http://164.100.129.4/netnrega/state_html/Fortnight_rep3.aspx?page=S&mon=07&lflag=eng&state_name=UTTAR PRADESH&state_code=31&fin_year=2015-2016&Digest=I1zykK+ple46ESl2ypMJ5Q	\N	muster roll where attendance not filled	muster roll where attendance not filled	unfilledmusterroll	Unfilled Muster Roll	1	No	1
12	1	http://164.100.129.4/netnrega/msr_detail_nt.aspx?lflag=eng&state_code=31&state_name=UTTAR+PRADESH&page=S&fin_year=2015-2016&Digest=+pigt/mKHOt4H/osrLXAYw	\N	Muster Roll Info	Muster Roll Info	musterroll	Unfilled Muster Roll	\N		1
7	0	http://164.100.129.6/netnrega/sec_sub_work_category.aspx?state_code=31&page=B&rcode=B&rsubcode=4&rsec_code=W09&fin_year=2015-2016&block_code=3120002&state_name=UTTAR%20PRADESH&district_name=AGRA&block_name=ACHHNERA	\N	आवास 	IAY /Lohia Awaas Houses	newhouses		10	1	1
\.


--
-- Name: parameter_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--

SELECT pg_catalog.setval('parameter_id_seq', 12, true);


--
-- Name: para_unique; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY parameter
    ADD CONSTRAINT para_unique UNIQUE (shortcode, type);


--
-- Name: parameter_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--

ALTER TABLE ONLY parameter
    ADD CONSTRAINT parameter_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

