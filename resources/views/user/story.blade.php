@extends('user.layout')

@section('title', 'Sky Chill Coffee - Tinh Hoa Đất Việt')

@section('css')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
<div class="reading-progress-container">
  <div class="reading-progress-bar" id="progressBar"></div>
</div>

<section class="story-intro-hero">
  <div class="intro-container">

    <div class="intro-header">
      <span class="intro-tagline">Since 2025 • Sky Chill Coffee</span>
      <h1>NHỮNG CÂU CHUYỆN <br> <span class="highlight">ĐẰNG SAU TÁCH CÀ PHÊ</span></h1>
      <div class="intro-line"></div>
    </div>

    <div class="intro-body">
      <p class="drop-cap">
        Chúng tôi tin rằng, một tách cà phê ngon không chỉ được quyết định bởi hạt cà phê hay cách pha, mà bởi cả hành trình dài phía sau nó. Một hành trình bắt đầu từ đất, từ thiên nhiên, từ bàn tay con người và kết thúc bằng khoảnh khắc bạn chậm lại, nâng tách cà phê lên và tận hưởng.
      </p>
      <p>
        Trong từng giọt cà phê là mồ hôi của người nông dân trên cao nguyên gió sương, là sự kiên nhẫn của những con người làm nghề luôn tôn trọng giá trị nguyên bản, và là khát vọng của những người trẻ mong muốn tạo nên điều tử tế giữa nhịp sống vội vã.
      </p>
      <p class="highlight-text">
        "Sky Chill Coffee không đơn thuần là nơi phục vụ đồ uống. Chúng tôi kể lại những câu chuyện về đất và người, về những hành trình âm thầm nhưng bền bỉ."
      </p>
    </div>

    <div class="scroll-indicator">
      <span>Bắt đầu hành trình</span>
      <div class="arrow-down"></div>
    </div>

  </div>
</section>

<div class="chapter-wrapper" id="coffee-chapter">
  <div class="sticky-col">
    <div class="frame-container">
      <img src="uploads/coffee-farm.jpg" class="story-img active">
      <img src="uploads/coffee-harvest.jpg" class="story-img">
      <img src="uploads/coffee-ferment.jpg" class="story-img">
      <img src="uploads/coffee-roast.jpg" class="story-img">
      <img src="uploads/coffee-brewing.jpg" class="story-img">
      <img src="uploads/coffee-cup.jpg" class="story-img">
    </div>
  </div>

  <div class="scroll-col">
    <div class="chapter-title"><h2>01. HÀNH TRÌNH CỦA HẠT NGỌC NÂU</h2><div class="line"></div></div>

    <div class="step-block active">
      <span class="step-number">01</span>
      <h3>Khởi Nguồn</h3>
      <h2>Nơi Sương Mù Ôm Ấp Đất Đỏ Bazan</h2>
      <p>
        Câu chuyện bắt đầu ở độ cao hơn 1.600 mét, nơi cao nguyên Cầu Đất thức dậy cùng sương sớm và những cơn gió mát lành thổi qua triền đồi. Ở đó, đất đỏ bazan giàu dinh dưỡng nằm yên lặng qua bao mùa nắng mưa, nuôi dưỡng từng gốc cà phê lớn lên chậm rãi và vững vàng.
        <br><br>
        Thiên nhiên nơi đây không hối thúc. Mọi thứ diễn ra theo nhịp điệu riêng: buổi sáng là sương mỏng, trưa là nắng nhẹ, chiều là những cơn mưa bất chợt. Chính sự cân bằng ấy đã giúp hạt cà phê tích tụ trọn vẹn tinh túy của đất trời, tạo nên nền tảng cho một hương vị sâu lắng và hài hòa.
      </p>
    </div>

    <div class="step-block">
      <span class="step-number">02</span>
      <h3>Tuyển Chọn</h3>
      <h2>Sự Khắt Khe Của Đôi Bàn Tay Người Thợ</h2>
      <p>
        Chúng tôi tin rằng, những giá trị bền vững không thể được tạo ra bằng sự vội vàng. Vì thế, cà phê tại Sky Chill không được thu hoạch bằng máy móc đại trà hay những phương pháp nhanh chóng.
        <br><br>
        Những người nông dân gắn bó với mảnh đất này lựa chọn từng trái cà phê bằng tay, chỉ hái khi quả đã chín đều và căng mọng. Đó là công việc đòi hỏi sự kiên nhẫn, tỉ mỉ và cả tình yêu với cây cà phê. Bởi chỉ khi được chọn lọc cẩn thận từ đầu, hạt cà phê mới mang trong mình vị ngọt tự nhiên và sự cân bằng dễ chịu khi thưởng thức.
      </p>
    </div>

    <div class="step-block">
      <span class="step-number">03</span>
      <h3>Chế Biến</h3>
      <h2>Đánh Thức “Linh Hồn” Của Hạt Cà Phê</h2>
      <p>
        Sau khi rời khỏi cành, hạt cà phê bước vào một giai đoạn lắng lại. Đây là khoảng thời gian quan trọng, nơi hạt cà phê được chăm sóc, theo dõi và để tự bộc lộ những tầng hương vốn tiềm ẩn bên trong.
        <br><br>
        Mọi công đoạn đều diễn ra chậm rãi, có chủ đích. Không có sự can thiệp vội vàng, chỉ có sự quan sát và điều chỉnh vừa đủ. Chính quá trình này giúp hạt cà phê giữ được sự hài hòa, tạo nên hương vị mềm mại, dễ cảm nhận và gần gũi với nhiều người, kể cả những ai mới bắt đầu uống cà phê.
      </p>
    </div>

    <div class="step-block">
      <span class="step-number">04</span>
      <h3>Biến Đổi</h3>
      <h2>Vũ Điệu Của Lửa Và Hương Thơm</h2>
      <p>
        Khi gặp lửa, hạt cà phê bước vào khoảnh khắc chuyển mình rõ rệt nhất. Từ màu xanh ban đầu, chúng dần đổi sắc, tỏa ra hương thơm ấm áp lan khắp không gian.
        <br><br>
        Người thợ rang đứng bên lò không chỉ để điều chỉnh nhiệt, mà để lắng nghe và cảm nhận. Từng âm thanh nhỏ, từng thay đổi màu sắc đều là tín hiệu cho thấy hạt cà phê đang đi đến điểm cân bằng. Mỗi mẻ rang là kết quả của kinh nghiệm, sự tập trung và cả cảm xúc, nhằm giữ lại trọn vẹn bản sắc vốn có của hạt cà phê.
      </p>
    </div>

    <div class="step-block">
      <span class="step-number">05</span>
      <h3>Chiết Xuất</h3>
      <h2>Giọt Tinh Túy Từ Sự Tận Tâm</h2>
      <p>
        Cà phê chỉ thật sự hoàn chỉnh khi được pha bằng sự tập trung và tôn trọng nguyên liệu. Từng bước nhỏ trong quá trình pha chế đều được thực hiện cẩn thận, để dòng cà phê chảy ra mang màu sắc hài hòa và hương thơm tròn đầy.
        <br><br>
        Với chúng tôi, pha cà phê không phải là thao tác lặp lại mỗi ngày, mà là khoảnh khắc kết nối giữa người làm và người thưởng thức. Đó là lúc cả hành trình dài phía sau được gói gọn trong từng giọt cà phê nhỏ bé.
      </p>
    </div>

    <div class="step-block">
      <span class="step-number">06</span>
      <h3>Thưởng Thức</h3>
      <h2>Bản Giao Hưởng Vị Giác Hoàn Hảo</h2>
      <p>
        Khi tách cà phê được đặt trước mặt bạn, hành trình ấy mới thật sự khép lại. Hãy dành một chút thời gian để cảm nhận hơi ấm lan tỏa nơi đầu ngón tay, hít nhẹ hương thơm thoảng lên và nhấp một ngụm nhỏ.
        <br><br>
        Vị đắng dịu dàng mở đầu, tiếp đến là cảm giác thanh nhẹ, và sau cùng là hậu vị ngọt lắng đọng rất lâu. Đó không chỉ là một thức uống, mà là câu chuyện được kể lại bằng hương và vị, dành riêng cho khoảnh khắc của bạn.
      </p>
    </div>

    <div style="height: 10vh;"></div>
  </div>
</div>


<div class="chapter-wrapper reverse-layout tea-theme" id="tea-chapter">
  <div class="sticky-col">
    <div class="frame-container">
      <img src="uploads/tea-hill.jpg" class="story-img active">
      <img src="uploads/tea-pluck.jpg" class="story-img">
      <img src="uploads/tea-dry.jpg" class="story-img">
      <img src="uploads/tea-cup.jpg" class="story-img">
    </div>
  </div>

  <div class="scroll-col">
    <div class="chapter-title"><h2>02. TINH HOA TRÀ VIỆT</h2><div class="line"></div></div>

    <div class="step-block active">
      <span class="step-number">01</span>
      <h3>Thiên Nhiên</h3>
      <h2>Cao Nguyên Bảo Lộc - Thủ Phủ Của Sự Bình Yên</h2>
      <p>
        Giữa những tầng mây và làn sương dày đặc, cao nguyên Bảo Lộc hiện lên với những đồi chè xanh mướt trải dài bất tận. Không gian nơi đây yên bình đến mức người ta có thể cảm nhận rõ nhịp thở của thiên nhiên.
        <br><br>
        Cây chè lớn lên trong sự chậm rãi ấy, hấp thụ tinh khí đất trời, những giọt sương sớm và ánh nắng dịu nhẹ. Chính môi trường trong lành này đã tạo nên hương trà thanh khiết và vị chát nhẹ rất riêng, khó nhầm lẫn.
      </p>
    </div>

    <div class="step-block">
      <span class="step-number">02</span>
      <h3>Tiêu Chuẩn</h3>
      <h2>Quy Tắc Vàng: "Một Tôm Hai Lá"</h2>
      <p>
        Trà ngon bắt đầu từ sự chọn lọc nghiêm ngặt. Chỉ những búp non nhất cùng hai lá trẻ kế bên mới được hái vào thời điểm sương sớm còn đọng trên lá.
        <br><br>
        Đôi bàn tay người thợ nâng niu từng búp trà, giữ lại sự tươi nguyên và tinh thần của buổi sáng cao nguyên. Mỗi lần thu hái là một sự cam kết về chất lượng và sự trân trọng với thiên nhiên.
      </p>
    </div>

    <div class="step-block">
      <span class="step-number">03</span>
      <h3>Chế Biến</h3>
      <h2>Nghệ Thuật Sao Tẩm & Ướp Hương Cổ Truyền</h2>
      <p>
        Ngay sau khi thu hoạch, trà được xử lý trong ngày để giữ lại hương vị tươi mới. Điểm đặc biệt nằm ở công đoạn ướp hương thủ công, nơi trà được ủ cùng những loài hoa tự nhiên theo phương pháp truyền thống.
        <br><br>
        Hương hoa không lấn át, mà thấm dần vào từng thớ lá, tạo nên sự hòa quyện tinh tế, nhẹ nhàng và sâu lắng. Đó là thứ hương thơm không vội vàng, càng thưởng thức càng cảm nhận rõ.
      </p>
    </div>

    <div class="step-block">
      <span class="step-number">04</span>
      <h3>Thành Phẩm</h3>
      <h2>Sự Giao Thoa Giữa Truyền Thống & Hiện Đại</h2>
      <p>
        Từ nền tảng trà truyền thống, chúng tôi mang đến những cách thưởng thức gần gũi hơn với nhịp sống hiện đại. Trà được kết hợp cùng trái cây tươi, mang lại cảm giác mát lành và dễ chịu.
        <br><br>
        Mỗi ly trà là một khoảng lặng giữa ngày dài, giúp người thưởng thức chậm lại, hít thở sâu hơn và tìm lại sự cân bằng trong cuộc sống.
      </p>
    </div>
    <div style="height: 10vh;"></div>
  </div>
</div>


<div class="chapter-wrapper" id="brand-chapter">
  <div class="sticky-col">
    <div class="frame-container">
      <img src="uploads/it-coding.jpg" class="story-img active">
      <img src="uploads/coffee-shop1.jpg" class="story-img">
      <img src="uploads/coffee-shop2.jpg" class="story-img">
      <img src="uploads/startup.jpg" class="story-img">
    </div>
  </div>

  <div class="scroll-col">
    <div class="chapter-title"><h2>03. GIẤC MƠ KHỞI NGHIỆP</h2><div class="line"></div></div>

    <div class="step-block active">
      <span class="step-number">01</span>
      <h3>Khởi Điểm</h3>
      <h2>Từ Những Đêm Thức Trắng Cùng Màn Hình Máy Tính</h2>
      <p>
        Sky Chill Coffee không bắt đầu từ một người làm cà phê chuyên nghiệp, cũng không khởi nguồn từ một kế hoạch kinh doanh bài bản. Câu chuyện ấy bắt đầu rất giản dị, từ một sinh viên công nghệ quen thuộc với những đêm thức khuya kéo dài, những deadline dồn dập và ánh sáng xanh lạnh lẽo từ màn hình máy tính.
        <br><br>
        Trong những đêm như thế, khi thành phố đã chìm vào giấc ngủ, cà phê trở thành người bạn thầm lặng duy nhất. Không cần cầu kỳ, chỉ là một ly cà phê đủ ấm để giữ đôi mắt mở, đủ đắng để nhắc nhở rằng vẫn còn việc phải hoàn thành. Cà phê khi ấy không chỉ để tỉnh táo, mà là một điểm tựa tinh thần, giúp tiếp tục ngồi lại với những dòng suy nghĩ còn dang dở.
        <br><br>
        Chính từ những khoảnh khắc rất đời ấy, một câu hỏi dần hình thành: Liệu cà phê có thể trở thành nhiều hơn thế?
      </p>
    </div>

    <div class="step-block">
      <span class="step-number">02</span>
      <h3>Cảm Hứng</h3>
      <h2>Đi Tìm Một Góc Nhỏ Để Nương Tựa Giấc Mơ</h2>
      <p>
        Giữa nhịp sống hối hả của Sài Gòn, tôi bắt đầu lang thang tìm kiếm một không gian phù hợp cho mình. Không cần quá ồn ào, cũng không quá lạnh lẽo. Một nơi đủ yên tĩnh để tập trung làm việc, nhưng vẫn đủ ấm áp để không cảm thấy lạc lõng giữa đám đông xa lạ.
        <br><br>
        Tôi đi qua nhiều quán cà phê, ngồi ở nhiều góc nhỏ khác nhau, quan sát những con người xung quanh. Những người trẻ mang theo laptop, những nhóm bạn thì thầm về ý tưởng khởi nghiệp, những cá nhân lặng lẽ theo đuổi ước mơ riêng của mình. Và tôi nhận ra, mình không hề cô đơn trong hành trình ấy.
        <br><br>
        Có rất nhiều người trẻ ngoài kia cũng đang đi tìm một “chốn dừng chân” như vậy. Một nơi không chỉ để uống cà phê, mà để sắp xếp lại suy nghĩ, nạp thêm năng lượng và tiếp tục bước đi trên con đường mình đã chọn.
      </p>
    </div>

    <div class="step-block">
      <span class="step-number">03</span>
      <h3>Hình Thành</h3>
      <h2>Khi Một Ý Nghĩ Nhỏ Dần Trở Thành Khát Vọng</h2>
      <p>
        Ý tưởng về Sky Chill Coffee không đến trong một khoảnh khắc bùng nổ, mà lớn dần theo thời gian. Từ những buổi ngồi một mình, đến những cuộc trò chuyện vu vơ với bạn bè, rồi những lần tự hỏi: Nếu có một quán cà phê dành riêng cho những người đang nỗ lực mỗi ngày thì sao?
        <br><br>
        Đó sẽ là nơi không phán xét bạn vì ngồi quá lâu, không thúc giục bạn phải gọi thêm đồ, không khiến bạn cảm thấy lạc lõng khi chỉ có một mình. Một không gian đủ thoải mái để làm việc, đủ gần gũi để trò chuyện, và đủ yên tĩnh để lắng nghe chính mình.
        <br><br>
        Dần dần, ý nghĩ ấy không còn là một mong muốn mơ hồ, mà trở thành một khát vọng nghiêm túc: xây dựng một nơi chốn dành cho những con người đang đi trên hành trình của riêng họ.
      </p>
    </div>

    <div class="step-block">
      <span class="step-number">04</span>
      <h3>Hiện Thực</h3>
      <h2>Sky Chill Coffee – Trạm Dừng Của Những Kẻ Mộng Mơ</h2>
      <p>
        Sky Chill Coffee ra đời từ tất cả những điều đó. Không chỉ là một quán cà phê, đây là một trạm dừng – nơi bạn có thể ghé lại giữa hành trình dài của mình, dù là để làm việc, gặp gỡ, hay đơn giản là ngồi yên và thở chậm hơn một chút.
        <br><br>
        Chúng tôi không hứa hẹn sẽ mang đến những điều to lớn. Chúng tôi chỉ mong mỗi vị khách khi rời đi đều mang theo một chút cảm hứng, một chút bình yên, và một cảm giác được thấu hiểu.
        <br><br>
        Bởi chúng tôi tin rằng, dù hành trình phía trước có dài và nhiều thử thách đến đâu, chỉ cần có một nơi để quay về, để nạp lại năng lượng, thì giấc mơ nào cũng xứng đáng được tiếp tục nuôi dưỡng.
      </p>
    </div>
    <div style="height: 10vh;"></div>
  </div>
</div>

<section class="story-conclusion">
  <div class="conclusion-container">
    <div class="conclusion-icon">❝</div>

    <h2>Cảm Ơn Bạn Đã Lắng Nghe <br> Câu Chuyện Của Chúng Tôi</h2>

    <p>
      Những dòng chữ này chỉ kể được một phần của hành trình. Phần còn lại, chân thật và sống động nhất, không nằm trên màn hình mà nằm trong chính tách cà phê được pha chế bằng cả tấm lòng.
      <br><br>
      Chúng tôi tin rằng, cách tốt nhất để thấu hiểu một câu chuyện không phải là đọc, mà là nếm thử. Hãy để hương vị của Sky Chill Coffee kể nốt cho bạn nghe phần tuyệt vời nhất.
    </p>

    <div class="conclusion-actions">
      <span class="invite-text">Hương vị đang chờ bạn khám phá</span>
      <a href="menu" class="btn-story-cta">Xem Thực Đơn Ngay</a>
    </div>
  </div>
</section>

