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


















--

COPY parameter (id, type, link, parser, name_hi, name_en, shortcode, description, weight, unit, periodicity) FROM stdin;
5	1	http://164.100.129.6/netnrega/Citizen_html/stworkreptemp_n.aspx?lflag=eng&page=s&state_name=UTTAR+PRADESH&state_code=31&fin_year=2015-2016&Digest=BV7khWYyy5Hk0B1kh6+1gA	\N	कार्य श्रेणी 	Work Category	workcategory		8	Rs lakhs	1
6	1	http://164.100.129.6/netnrega/sec_sub_work_category.aspx?state_code=31&page=B&rcode=B&rsubcode=4&rsec_code=W09&fin_year=2015-2016&block_code=3120002&state_name=UTTAR%20PRADESH&district_name=AGRA&block_name=ACHHNERA	\N	कार्य श्रेणी उप श्रेणी 	work category sub category 	subcat		7	no	1
7	0	http://164.100.129.6/netnrega/sec_sub_work_category.aspx?state_code=31&page=B&rcode=B&rsubcode=4&rsec_code=W09&fin_year=2015-2016&block_code=3120002&state_name=UTTAR%20PRADESH&district_name=AGRA&block_name=ACHHNERA	\N	आवास 	IAY /Lohia Awaas Houses	houses		10	1	1
8	1	http://164.100.129.6/netnrega/sec_master_work_cat_work_pd.aspx?state_code=31&page=B&rcode=W01&fin_year=2015-2016&block_code=3120002&state_name=UTTAR%20PRADESH&district_name=AGRA&block_name=ACHHNERA	\N	जल सरंक्षण कार्य 	Water Conservation Works	water		8	no	1
10	0	http://localhost/basicmnrega/web/index.php/mnrega/parameter/genworkpage?cat=housing&level=1	\N	कार्य श्रेणी ब्लॉक वॉर 	Work categories Block wise	houses		5	No	1
11	1	http://164.100.129.6/netnrega/writereaddata/state_out/Empstatusall31_1516_.html	\N	रोज़गार की जानकारी 	Employment status 	empstatus		5	No	1
4	1	http://localhost/basicmnrega/web/images/page3.html	\N	test	test	mandays	test	10	test	1
9	\N	http://localhost/basicmnrega/web/index.php/mnrega/default/genpage?cat=housing&level=0	\N	कार्य श्रेणी जिले वार 	work categories district wise	houses		5	No	1
\.


--
-- Name: parameter_id_seq; Type: SEQUENCE SET; Schema: public; Owner: mac
--



--
-- Name: parameter_pkey; Type: CONSTRAINT; Schema: public; Owner: mac; Tablespace: 
--



--
-- PostgreSQL database dump complete
--

