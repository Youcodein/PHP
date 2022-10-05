<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php include "../include/link.php" ?>
    <!-- link -->
</head>
<body>
    <div id="skip">
        <a href="#headerType">헤더 영역 바로가기</a>
        <a href="#headerType">컨텐츠 영역 바로가기</a>
        <a href="#headerType">푸터 영역 바로가기</a>

    </div>
    <!-- skip -->


    <?php include "../include/header.php" ?>
    <!-- header -->

    <main id="main">

        <section id="board" class="container">
            <h2>게시판 보기 영역입니다.</h2>
            <div class="board__inner">
                <div class="board__title">
                    <h3>게시판</h3>
                    <p>웹디자이너, 웹퍼블리셔, 프론트엔드 개발자를 위한 게시판입니다.</p>
                </div>
                <div class="board__view">
                    <table>
                        <colgroup>
                            <col style="width: 20%;">
                            <col style="width: 80%;">
                        </colgroup>
                        <tbody>
<?php
    $myBoardID = $_GET['myBoardID'];
    // echo $myBoardID;

    $sql = "SELECT b.boardTitle, m.youName, b.regTime, b.boardView, b.boardContents FROM myBoard b JOIN myMember m  ON(m.myMemberID = b.myMemberID) WHERE b.myBoardID = $myBoardID";
    $result = $connect -> query($sql);

    //보드 뷰 + 1(update사용)
    $sql2 = "UPDATE myBoard SET boardView = boardView + 1 WHERE myboardID = $myBoardID";



    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);

        // echo "<pre>";
        // var_dump($info);
        // echo "</pre>";
        echo "<tr><th>제목</th><td>".$info['boardTitle']."</td></tr>";
        echo "<tr><th>등록자</th><td>".$info['youName']."</td></tr>";
        echo "<tr><th>등록일</th><td>".date('Y-m-d H:i', $info['regTime'])."</td></tr>";
        echo "<tr><th>조회수</th><td>".$info['boardView']."</td></tr>";
        echo "<tr><th>내용</th><td class='height' >".$info['boardContents']."</td></tr>";
    }
?>
                            <!-- <tr>
                                <th>제목</th>
                                <td>게시판 제목입니다.</td>
                            </tr>
                            <tr>
                                <th>등록자</th>
                                <td>지닝</td>
                            </tr>

                            <tr>
                                <th>등록일</th>
                                <td>2022-03-04</td>
                            </tr>

                            <tr>
                                <th>조회수</th>
                                <td>999</td>
                            </tr>

                            <tr>
                                <th>내용</th>
                                <td class="height">그게그렇게됐다. 안타깝게도말이다 <br>졸려죽겟음</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>

                <div class="board__btn">
                    <a href="boardModify.php?myBoardID=<?=$myBoardID?>">수정하기</a>
                    <a href="boardRemove.php?myBoardID=<?=$myBoardID?>" onclick ="alert('정말 삭제하시겠습니까?')">삭제하기</a>
                    <a href="board.php">목록보기</a>
                </div>
            </div>

        </section>
        <!-- board -->

    </main>
    <!-- //main -->

    <?php include "../include/footer.php" ?>

    <!-- footer -->
</body>
</html>