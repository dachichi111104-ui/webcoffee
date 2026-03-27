--
-- PostgreSQL database dump
--

\restrict dCWgV69rhhI5sdDUAho2ecc5pbCEaWSH7r8f4D4pZUB84t7yCqJJV6CeYIJTdce

-- Dumped from database version 18.1
-- Dumped by pg_dump version 18.1

-- Started on 2026-01-08 15:33:27

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 222 (class 1259 OID 17617)
-- Name: admin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.admin (
    idadmin bigint NOT NULL,
    emailadmin character varying(255) NOT NULL,
    passadmin character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.admin OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 17616)
-- Name: admin_idadmin_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.admin_idadmin_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.admin_idadmin_seq OWNER TO postgres;

--
-- TOC entry 5120 (class 0 OID 0)
-- Dependencies: 221
-- Name: admin_idadmin_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.admin_idadmin_seq OWNED BY public.admin.idadmin;


--
-- TOC entry 232 (class 1259 OID 17764)
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 17775)
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 17827)
-- Name: chitietdonhang; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.chitietdonhang (
    iddonhang bigint NOT NULL,
    idsp bigint NOT NULL,
    soluong integer NOT NULL,
    dongia numeric(10,2) NOT NULL
);


ALTER TABLE public.chitietdonhang OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 17693)
-- Name: donhang; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.donhang (
    iddonhang bigint NOT NULL,
    idnguoidung bigint NOT NULL,
    tongtien numeric(10,2) NOT NULL,
    tennguoinhan character varying(255) NOT NULL,
    sodienthoainguoinhan character varying(255) NOT NULL,
    diachinhanhang character varying(255) NOT NULL,
    ghichu text,
    phuongthucthanhtoan character varying(255) DEFAULT 'tien_mat'::character varying NOT NULL,
    trangthaidonhang character varying(255) DEFAULT 'cho_xu_ly'::character varying NOT NULL,
    ngaydat timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT donhang_phuongthucthanhtoan_check CHECK (((phuongthucthanhtoan)::text = ANY ((ARRAY['tien_mat'::character varying, 'chuyen_khoan'::character varying, 'momo'::character varying])::text[]))),
    CONSTRAINT donhang_trangthaidonhang_check CHECK (((trangthaidonhang)::text = ANY ((ARRAY['cho_xu_ly'::character varying, 'dang_giao'::character varying, 'hoan_thanh'::character varying, 'da_huy'::character varying])::text[])))
);


ALTER TABLE public.donhang OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 17692)
-- Name: donhang_iddonhang_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.donhang_iddonhang_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.donhang_iddonhang_seq OWNER TO postgres;

--
-- TOC entry 5121 (class 0 OID 0)
-- Dependencies: 229
-- Name: donhang_iddonhang_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.donhang_iddonhang_seq OWNED BY public.donhang.iddonhang;


--
-- TOC entry 234 (class 1259 OID 17808)
-- Name: giohang; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.giohang (
    idnguoidung bigint NOT NULL,
    idsp bigint NOT NULL,
    soluong integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.giohang OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 17649)
-- Name: loaisp; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.loaisp (
    idloai bigint NOT NULL,
    tenloai character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.loaisp OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 17648)
-- Name: loaisp_idloai_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.loaisp_idloai_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.loaisp_idloai_seq OWNER TO postgres;

--
-- TOC entry 5122 (class 0 OID 0)
-- Dependencies: 225
-- Name: loaisp_idloai_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.loaisp_idloai_seq OWNED BY public.loaisp.idloai;


--
-- TOC entry 220 (class 1259 OID 17607)
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 17606)
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- TOC entry 5123 (class 0 OID 0)
-- Dependencies: 219
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- TOC entry 224 (class 1259 OID 17631)
-- Name: nguoi_dung; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.nguoi_dung (
    idnguoidung bigint NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    ten character varying(255) NOT NULL,
    sdt character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.nguoi_dung OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 17630)
-- Name: nguoi_dung_idnguoidung_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.nguoi_dung_idnguoidung_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.nguoi_dung_idnguoidung_seq OWNER TO postgres;

--
-- TOC entry 5124 (class 0 OID 0)
-- Dependencies: 223
-- Name: nguoi_dung_idnguoidung_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.nguoi_dung_idnguoidung_seq OWNED BY public.nguoi_dung.idnguoidung;


--
-- TOC entry 228 (class 1259 OID 17658)
-- Name: sanpham; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sanpham (
    idsp bigint NOT NULL,
    idloai bigint NOT NULL,
    tensp character varying(255) NOT NULL,
    gia numeric(10,2) NOT NULL,
    soluong integer NOT NULL,
    hinhanh character varying(255),
    mota text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.sanpham OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 17657)
-- Name: sanpham_idsp_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sanpham_idsp_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sanpham_idsp_seq OWNER TO postgres;

--
-- TOC entry 5125 (class 0 OID 0)
-- Dependencies: 227
-- Name: sanpham_idsp_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sanpham_idsp_seq OWNED BY public.sanpham.idsp;


--
-- TOC entry 231 (class 1259 OID 17752)
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- TOC entry 4902 (class 2604 OID 17620)
-- Name: admin idadmin; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin ALTER COLUMN idadmin SET DEFAULT nextval('public.admin_idadmin_seq'::regclass);


--
-- TOC entry 4906 (class 2604 OID 17696)
-- Name: donhang iddonhang; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.donhang ALTER COLUMN iddonhang SET DEFAULT nextval('public.donhang_iddonhang_seq'::regclass);


--
-- TOC entry 4904 (class 2604 OID 17652)
-- Name: loaisp idloai; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.loaisp ALTER COLUMN idloai SET DEFAULT nextval('public.loaisp_idloai_seq'::regclass);


--
-- TOC entry 4901 (class 2604 OID 17610)
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- TOC entry 4903 (class 2604 OID 17634)
-- Name: nguoi_dung idnguoidung; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nguoi_dung ALTER COLUMN idnguoidung SET DEFAULT nextval('public.nguoi_dung_idnguoidung_seq'::regclass);


--
-- TOC entry 4905 (class 2604 OID 17661)
-- Name: sanpham idsp; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sanpham ALTER COLUMN idsp SET DEFAULT nextval('public.sanpham_idsp_seq'::regclass);


--
-- TOC entry 5101 (class 0 OID 17617)
-- Dependencies: 222
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.admin (idadmin, emailadmin, passadmin, created_at, updated_at) FROM stdin;
1	admin@gmail.com	$2y$12$GKM4xk9TpUWPFfE5z4MRXexSH3YRbkiCDd4gOJRezRiOiecPNhqQa	2025-12-31 20:08:02	2025-12-31 20:08:02
\.


--
-- TOC entry 5111 (class 0 OID 17764)
-- Dependencies: 232
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- TOC entry 5112 (class 0 OID 17775)
-- Dependencies: 233
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- TOC entry 5114 (class 0 OID 17827)
-- Dependencies: 235
-- Data for Name: chitietdonhang; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.chitietdonhang (iddonhang, idsp, soluong, dongia) FROM stdin;
1	1	1	55000.00
1	2	1	55000.00
1	3	1	55000.00
2	2	1	55000.00
9	1	1	55000.00
9	10	1	55000.00
10	10	1	55000.00
11	2	1	55000.00
11	8	1	40000.00
\.


--
-- TOC entry 5109 (class 0 OID 17693)
-- Dependencies: 230
-- Data for Name: donhang; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.donhang (iddonhang, idnguoidung, tongtien, tennguoinhan, sodienthoainguoinhan, diachinhanhang, ghichu, phuongthucthanhtoan, trangthaidonhang, ngaydat, created_at, updated_at) FROM stdin;
2	1	55000.00	Trinh	0909090909	415/43	\N	momo	da_huy	2026-01-01 14:48:50	2026-01-01 14:48:50	2026-01-02 12:45:48
1	1	165000.00	Vi	0927018718	415	0	tien_mat	hoan_thanh	2026-01-01 13:01:38	2026-01-01 13:01:38	2026-01-02 15:10:47
9	2	110000.00	Trúc	0989484083	Đồng Nai	70 đường 70 đá	tien_mat	cho_xu_ly	2026-01-03 17:34:59	2026-01-03 17:34:59	2026-01-03 17:34:59
10	4	55000.00	Hân	0984323432	83/27 Phạm Văn Bạch	cho thêm 1 nước suối	tien_mat	dang_giao	2026-01-06 00:11:20	2026-01-06 00:11:20	2026-01-06 00:12:55
11	4	95000.00	Trinh	0984323432	415 Trường Chinh	0 đá	momo	cho_xu_ly	2026-01-06 14:51:12	2026-01-06 14:51:12	2026-01-06 14:51:12
\.


--
-- TOC entry 5113 (class 0 OID 17808)
-- Dependencies: 234
-- Data for Name: giohang; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.giohang (idnguoidung, idsp, soluong) FROM stdin;
3	8	2
\.


--
-- TOC entry 5105 (class 0 OID 17649)
-- Dependencies: 226
-- Data for Name: loaisp; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.loaisp (idloai, tenloai, created_at, updated_at) FROM stdin;
1	Coffee	\N	\N
2	Tea	\N	\N
3	Matcha	\N	\N
4	Freeze	\N	\N
5	Milk Tea	\N	\N
\.


--
-- TOC entry 5099 (class 0 OID 17607)
-- Dependencies: 220
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2025_12_26_193658_tao_bang_admin	1
2	2025_12_26_193708_tao_bang_nguoidung	1
3	2025_12_26_193715_tao_bang_loaisp	1
4	2025_12_26_193720_tao_bang_sanpham	1
6	2025_12_26_193738_tao_bang_donhang	1
8	2025_12_26_193749_tao_bang_yeuthich	1
9	2025_12_26_200659_create_sessions_table	1
10	2025_12_28_202741_create_cache_table	1
12	2025_12_26_193726_tao_bang_giohang	2
13	2025_12_26_193743_tao_bang_chitietdonhang	2
14	2026_01_02_133419_create_thongbao_table	3
\.


--
-- TOC entry 5103 (class 0 OID 17631)
-- Dependencies: 224
-- Data for Name: nguoi_dung; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.nguoi_dung (idnguoidung, email, password, ten, sdt, created_at, updated_at) FROM stdin;
1	lengoctrinh2712@gmail.com	$2y$12$ENXdRLLWQYyoU47dMJp3aOE/3EXUwASPBqyr3G3ecx85IxFKcA1jO	Trinh	0909090909	2025-12-31 14:11:55	2025-12-31 14:11:55
2	pttt0000@gmail.com	$2y$12$6qgCYWR3MjvNeAZNEcMgNen01L9Vbdhs6C8DIaUGagIY.PvfxDqu6	Thanh Trúc	0973653739	2026-01-03 17:27:27	2026-01-03 17:27:27
3	gnghihihihi@gmail.com	$2y$12$f34K/GxepnrHTCq6uS1MPuSSkOf4J.Ib3GORT6yx0Hx6eEY8PV4CW	Gia Nghi	0776985586	2026-01-03 19:08:14	2026-01-03 19:08:14
4	thitluoccuonbanhtrang@gmail.com	$2y$12$i6MIdCf6g4R85LR/W0gmkuwU2SaSD4uo/rL.LXN7YLs9FzjgLPo/u	Hân	0984323432	2026-01-06 00:09:25	2026-01-06 00:09:25
\.


--
-- TOC entry 5107 (class 0 OID 17658)
-- Dependencies: 228
-- Data for Name: sanpham; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sanpham (idsp, idloai, tensp, gia, soluong, hinhanh, mota, created_at, updated_at) FROM stdin;
1	1	Latte Coffee	55000.00	1000	1767188551_1767037570_cappuccino-coffee.png	Latte là thức uống cà phê Ý dịu nhẹ, kết hợp giữa một phần espresso, hai phần sữa nóng và một lớp bọt sữa mỏng ở trên, tạo nên vị béo ngậy, thơm lừng, cân bằng vị đắng của cà phê và vị ngọt thanh của sữa, được trang trí bằng nghệ thuật vẽ trên bọt sữa tinh xảo.	2025-12-31 13:42:31	2025-12-31 13:42:31
2	1	Espresso Coffee	55000.00	1000	1767188690_1767039023_espresso-coffee.png	Espresso là loại cà phê Ý đậm đặc, được pha bằng cách ép nước nóng dưới áp suất cao qua cà phê xay mịn, tạo ra một shot nhỏ hương vị mạnh mẽ, sánh mịn và có lớp bọt vàng óng đặc trưng gọi là crema trên bề mặt, mang vị đắng sâu, hậu vị ngọt.	2025-12-31 13:44:50	2025-12-31 13:44:50
3	1	Espresso Macchiato	55000.00	1000	1767188800_1767039042_espresso-macchiato.png	Espresso Macchiato là một tách espresso đậm đặc có một lượng nhỏ sữa được đánh bọt mịn phủ lên trên, giúp làm dịu bớt vị đắng mạnh mẽ của espresso mà không làm mất đi hương vị cà phê nguyên bản, lý tưởng cho người thích vị đậm đà nhưng cần chút béo nhẹ.	2025-12-31 13:46:40	2025-12-31 13:46:40
4	1	Americano	55000.00	1000	1767188897_1767039302_americanoi.png	Americano cơ bản là một thức uống espresso được pha loãng bằng nước nóng, giữ hương vị cà phê nguyên bản nhưng nhẹ nhàng hơn, không sữa, không đường. Nó là sự kết hợp của 1 shot espresso với lượng nước nóng gấp đôi hoặc gấp ba, tạo cảm giác êm dịu, dễ uống hơn nhưng vẫn giữ được độ đậm và lớp crema đặc trưng của espresso.	2025-12-31 13:48:17	2025-12-31 13:48:17
5	2	Black Tea	40000.00	1000	1767188984_1767039324_black-tea.png	Trà đen là loại trà được oxy hóa hoàn toàn, có sợi lá màu đen sẫm, nước pha màu đỏ trong, vị đậm đà đặc trưng. Quy trình sản xuất khác biệt so với trà xanh, tạo nên màu sắc, hương vị độc đáo và hàm lượng caffeine cao hơn, mang lại cảm giác ấm áp, tỉnh táo khi thưởng thức.	2025-12-31 13:49:44	2025-12-31 13:49:44
6	2	Lemon Tea	40000.00	1000	1767189056_1767039363_lemon-tea.png	Lemon Tea là thức uống kết hợp giữa vị chát thơm đặc trưng của trà cùng vị chua thanh mát của chanh, có vị ngọt cân bằng, tạo cảm giác sảng khoái, tỉnh táo, giúp giải nhiệt và kích thích tiêu hóa.	2025-12-31 13:50:56	2025-12-31 13:50:56
7	2	Green Tea	40000.00	1000	1767189154_1767039342_green-tea.png	Green Tea là thức uống phổ biến từ lá cây Camellia sinensis, có màu xanh đặc trưng, vị thanh mát, hơi chát, hậu vị ngọt và giàu chất chống oxy hóa, giúp tỉnh táo, hỗ trợ sức khỏe da.	2025-12-31 13:52:34	2025-12-31 13:52:34
8	2	Strawberry Tea	40000.00	1000	1767189284_1767039543_strawberry-tea.png	Strawberry Tea là thức uống trái cây hiện đại kết hợp hương thơm quyến rũ của dâu tây với vị trà, tạo ra một thức uống có màu đỏ tươi, vị ngọt thanh mát, chát nhẹ, hương thơm đậm đà, dùng nóng hoặc lạnh đều ngon, mang lại cảm giác sảng khoái và tốt cho sức khỏe.	2025-12-31 13:54:44	2025-12-31 13:54:44
9	2	Peach Tea	40000.00	1000	1767189386_1767039714_peach.png	Peach Tea là thức uống giải khát phổ biến, kết hợp hương thơm quyến rũ của trái đào chín mọng với vị chát nhẹ thanh mát của trà đen, tạo nên vị ngọt dịu, thơm lừng, giúp giải nhiệt và thư giãn hiệu quả.	2025-12-31 13:56:26	2025-12-31 13:56:26
10	3	Matcha Latte	55000.00	1000	1767189462_1767039386_matcha-latte.png	Matcha Latte là thức uống kết hợp tinh tế giữa vị chát nhẹ, thanh mát đặc trưng của bột trà xanh Matcha Nhật Bản với vị béo ngậy, ngọt dịu của sữa tươi, tạo nên hương vị hòa quyện độc đáo.	2025-12-31 13:57:42	2025-12-31 13:57:42
13	4	Cookie & Cream	50000.00	1000	1767189860_1767039959_cookie.png	Cookie & Cream là thức uống đá xay mát lạnh, béo ngậy, kết hợp hoàn hảo giữa vị kem vani ngọt ngào, sữa tươi và vụn bánh quy sô cô la giòn tan, với lớp kem tươi béo ngậy và vụn bánh quy vụn nhuyễn bên trên, tạo nên hương vị béo mịn, ngọt ngào, "tan chảy".	2025-12-31 14:04:20	2025-12-31 14:04:20
14	5	Milk Tea	50000.00	1000	1767189962_1767039771_milk.png	Milk Tea là thức uống kết hợp giữa trà và sữa, tạo nên hương vị béo ngậy, thơm dịu đặc trưng, có thể thêm các topping như trân châu, thạch, lô hội, hoặc đậu đỏ để tăng sự hấp dẫn.	2025-12-31 14:06:02	2025-12-31 14:06:02
11	4	Freeze Matcha	50000.00	1000	1767189577_1767039910_matcha.png	Matcha Freeze là thức uống đá xay kết hợp hương vị trà xanh nguyên bản với đá, sữa, và kem béo, tạo nên lớp kem mịn màng, mát lạnh, thơm béo và sánh quyện.	2025-12-31 13:59:37	2026-01-01 07:07:04
12	4	Freeze Chocolate	50000.00	1000	1767189738_1767039927_choco.png	Chocolate Freeze là thức uống xay nhuyễn từ đá, sữa, bột chocolate nguyên chất, tạo nên hỗn hợp sánh mịn, mát lạnh, có vị đậm đà, béo ngậy và ngọt ngào, được phủ thêm whipping cream và sốt chocolate.	2025-12-31 14:02:18	2026-01-01 07:07:25
\.


--
-- TOC entry 5110 (class 0 OID 17752)
-- Dependencies: 231
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
GgUELLtsCVjXCuGNRst8UmScjGfUcmLHSvfqy5Yg	4	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36	YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQVFEN1Rwd3luS09VbDJFQk9zQUVSNTRNbFJDSkthelJNVWw2dTNKTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kb25oYW5nIjtzOjU6InJvdXRlIjtzOjE5OiJhZG1pbi5kb25oYW5nLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==	1767658375
EFN07IdWRuplpQ8Gba4lXj35kbeOozshioQcXik0	\N	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36	YTozOntzOjY6Il90b2tlbiI7czo0MDoiYklrSEgxeG5wSER2Wkd5S281SjdOQ0dKbXVVRDYxNnhINzF5SmhLVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tZW51IjtzOjU6InJvdXRlIjtzOjQ6Im1lbnUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1767670239
dJvU89sFijD5cKVXkIgKiB92tnSP69VI7TtwRdpI	4	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36	YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWVpOUEQxT1Z6RU5xeHVYSjBoWjlOdHhHZGd6c2hTWWVodUw0OGkyciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi90aG9uZ2tlIjtzOjU6InJvdXRlIjtzOjE5OiJhZG1pbi50aG9uZ2tlLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==	1767711116
YOXmj4vSLMMT00qJOpOLGlVy0TPZeFF7Wywxysx5	1	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36	YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRUlrTnB5b2hNRWpXU29QRlg4eUdrUFB1blVXRTliaDFLQkFLaldtNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9	1767856953
\.


--
-- TOC entry 5126 (class 0 OID 0)
-- Dependencies: 221
-- Name: admin_idadmin_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.admin_idadmin_seq', 1, false);


--
-- TOC entry 5127 (class 0 OID 0)
-- Dependencies: 229
-- Name: donhang_iddonhang_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.donhang_iddonhang_seq', 11, true);


--
-- TOC entry 5128 (class 0 OID 0)
-- Dependencies: 225
-- Name: loaisp_idloai_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.loaisp_idloai_seq', 5, true);


--
-- TOC entry 5129 (class 0 OID 0)
-- Dependencies: 219
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 14, true);


--
-- TOC entry 5130 (class 0 OID 0)
-- Dependencies: 223
-- Name: nguoi_dung_idnguoidung_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.nguoi_dung_idnguoidung_seq', 4, true);


--
-- TOC entry 5131 (class 0 OID 0)
-- Dependencies: 227
-- Name: sanpham_idsp_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sanpham_idsp_seq', 14, true);


--
-- TOC entry 4916 (class 2606 OID 17629)
-- Name: admin admin_emailadmin_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_emailadmin_unique UNIQUE (emailadmin);


--
-- TOC entry 4918 (class 2606 OID 17627)
-- Name: admin admin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admin
    ADD CONSTRAINT admin_pkey PRIMARY KEY (idadmin);


--
-- TOC entry 4940 (class 2606 OID 17784)
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- TOC entry 4937 (class 2606 OID 17773)
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- TOC entry 4944 (class 2606 OID 17835)
-- Name: chitietdonhang chitietdonhang_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chitietdonhang
    ADD CONSTRAINT chitietdonhang_pkey PRIMARY KEY (iddonhang, idsp);


--
-- TOC entry 4930 (class 2606 OID 17714)
-- Name: donhang donhang_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.donhang
    ADD CONSTRAINT donhang_pkey PRIMARY KEY (iddonhang);


--
-- TOC entry 4942 (class 2606 OID 17816)
-- Name: giohang giohang_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.giohang
    ADD CONSTRAINT giohang_pkey PRIMARY KEY (idnguoidung, idsp);


--
-- TOC entry 4926 (class 2606 OID 17656)
-- Name: loaisp loaisp_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.loaisp
    ADD CONSTRAINT loaisp_pkey PRIMARY KEY (idloai);


--
-- TOC entry 4914 (class 2606 OID 17615)
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- TOC entry 4920 (class 2606 OID 17645)
-- Name: nguoi_dung nguoi_dung_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nguoi_dung
    ADD CONSTRAINT nguoi_dung_email_unique UNIQUE (email);


--
-- TOC entry 4922 (class 2606 OID 17643)
-- Name: nguoi_dung nguoi_dung_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nguoi_dung
    ADD CONSTRAINT nguoi_dung_pkey PRIMARY KEY (idnguoidung);


--
-- TOC entry 4924 (class 2606 OID 17647)
-- Name: nguoi_dung nguoi_dung_sdt_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.nguoi_dung
    ADD CONSTRAINT nguoi_dung_sdt_unique UNIQUE (sdt);


--
-- TOC entry 4928 (class 2606 OID 17670)
-- Name: sanpham sanpham_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sanpham
    ADD CONSTRAINT sanpham_pkey PRIMARY KEY (idsp);


--
-- TOC entry 4933 (class 2606 OID 17761)
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- TOC entry 4935 (class 1259 OID 17774)
-- Name: cache_expiration_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX cache_expiration_index ON public.cache USING btree (expiration);


--
-- TOC entry 4938 (class 1259 OID 17785)
-- Name: cache_locks_expiration_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX cache_locks_expiration_index ON public.cache_locks USING btree (expiration);


--
-- TOC entry 4931 (class 1259 OID 17763)
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- TOC entry 4934 (class 1259 OID 17762)
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- TOC entry 4949 (class 2606 OID 17836)
-- Name: chitietdonhang chitietdonhang_iddonhang_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chitietdonhang
    ADD CONSTRAINT chitietdonhang_iddonhang_foreign FOREIGN KEY (iddonhang) REFERENCES public.donhang(iddonhang) ON DELETE CASCADE;


--
-- TOC entry 4950 (class 2606 OID 17841)
-- Name: chitietdonhang chitietdonhang_idsp_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chitietdonhang
    ADD CONSTRAINT chitietdonhang_idsp_foreign FOREIGN KEY (idsp) REFERENCES public.sanpham(idsp) ON DELETE CASCADE;


--
-- TOC entry 4946 (class 2606 OID 17715)
-- Name: donhang donhang_idnguoidung_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.donhang
    ADD CONSTRAINT donhang_idnguoidung_foreign FOREIGN KEY (idnguoidung) REFERENCES public.nguoi_dung(idnguoidung) ON DELETE CASCADE;


--
-- TOC entry 4947 (class 2606 OID 17817)
-- Name: giohang giohang_idnguoidung_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.giohang
    ADD CONSTRAINT giohang_idnguoidung_foreign FOREIGN KEY (idnguoidung) REFERENCES public.nguoi_dung(idnguoidung) ON DELETE CASCADE;


--
-- TOC entry 4948 (class 2606 OID 17822)
-- Name: giohang giohang_idsp_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.giohang
    ADD CONSTRAINT giohang_idsp_foreign FOREIGN KEY (idsp) REFERENCES public.sanpham(idsp) ON DELETE CASCADE;


--
-- TOC entry 4945 (class 2606 OID 17671)
-- Name: sanpham sanpham_idloai_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sanpham
    ADD CONSTRAINT sanpham_idloai_foreign FOREIGN KEY (idloai) REFERENCES public.loaisp(idloai) ON DELETE CASCADE;


-- Completed on 2026-01-08 15:33:28

--
-- PostgreSQL database dump complete
--

\unrestrict dCWgV69rhhI5sdDUAho2ecc5pbCEaWSH7r8f4D4pZUB84t7yCqJJV6CeYIJTdce

