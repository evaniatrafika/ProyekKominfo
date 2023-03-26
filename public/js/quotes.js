$(document).ready(function(){
    var quoteSource=[
    {
        quote: "Start by doing what's necessary; then do what's possible; and suddenly you are doing the impossible.",
        name:"Francis of Assisi"
    },
    {
        quote:"Believe you can and you're halfway there.",
        name:"Theodore Roosevelt"
    },
    {
        quote:"It does not matter how slowly you go as long as you do not stop.",
        name:"Confucius"
    },
    {
        quote:"Our greatest weakness lies in giving up. The most certain way to succeed is always to try just one more time.",
        name:"Thomas A. Edison"
    },
    {
        quote:"The will to win, the desire to succeed, the urge to reach your full potential... these are the keys that will unlock the door to personal excellence.",
        name:"Confucius"
    },
    {
        quote:"Don't watch the clock; do what it does. Keep going.",
        name:"Sam Levenson"
    },
    {
        quote:"A creative man is motivated by the desire to achieve, not by the desire to beat others.",
        name:"Ayn Rand"
    },
    {
        quote:"A creative man is motivated by the desire to achieve, not by the desire to beat others.",
        name:"Ayn Rand"
    },
    {
        quote:"Expect problems and eat them for breakfast.",
        name:"Alfred A. Montapert"
    },
    {
        quote:"Start where you are. Use what you have. Do what you can.",
        name:"Arthur Ashe"
    },
    {
        quote:"Ever tried. Ever failed. No matter. Try Again. Fail again. Fail better.",
        name:"Samuel Beckett"
    },
    {
        quote:"Be yourself; everyone else is already taken.",
        name:"Oscar Wilde"
    },
    {
        quote:"Two things are infinite: the universe and human stupidity; and I'm not sure about the universe.",
        name:"Albert Einstein"
    },
    {
        quote:"Always remember that you are absolutely unique. Just like everyone else.",
        name:"Margaret Mead"
    },
    {
        quote:"Do not take life too seriously. You will never get out of it alive.",
        name:"Elbert Hubbard"
    },
    {
        quote:"People who think they know everything are a great annoyance to those of us who do.",
        name:"Isaac Asimov"
    },
    {
        quote:"Procrastination is the art of keeping up with yesterday.",
        name:"Don Marquis"
    },
    {
        quote:"Get your facts first, then you can distort them as you please.",
        name:"Mark Twain"
    },
    {
        quote:"A day without sunshine is like, you know, night.",
        name:"Steve Martin"
    },
    {
        quote:"My grandmother started walking five miles a day when she was sixty. She's ninety-seven now, and we don't know where the hell she is.",
        name:"Ellen DeGeneres"
    },
    {
        quote:"Don't sweat the petty things and don't pet the sweaty things.",
        name:"George Carlin"
    },
    {
        quote:"Always do whatever's next.",
        name:"George Carlin"
    },
    {
        quote:"Atheism is a non-prophet organization.",
        name:"George Carlin"
    },
    {
        quote:"Any fool can write code that a computer can understand. Good programmers write code that humans can understand.",
        name:"Martin Fowler"
    },
    {
        quote:"First, solve the problem. Then, write the code.",
        name:" John Johnson"
    },
    {
        quote:"Experience is the name everyone gives to their mistakes.",
        name:"Oscar Wilde"
    },
    {
        quote:" In order to be irreplaceable, one must always be different",
        name:"Coco Chanel"
    },
    {
        quote:"Knowledge is power.",
        name:"Francis Bacon"
    },
    {
        quote:"Simplicity is the soul of efficiency.",
        name:"Austin Freeman"
    },
    {
        quote:"Austin Freeman",
        name:"Kent Beck"
    },
    {
        quote:"Seorang programmer adalah mereka yang terlihat sebagai seorang ahli, Tetapi sebenarnya untuk menciptakan program yang sempurnah Dibutuhkan tekad dan kekuatan terbesar untuk terus mempelajari hal baru",
        name:"Someone There"
    },
    {
        quote:"Sebuah komputer layak disebut cerdas jika dapat menipu manusia agar percaya bahwa itu adalah manusia.",
        name:"Alan Turing"
    },
    {
        quote:"Programmer yang kompeten menyadari sepenuhnya kapasitas otaknya yang terbatas. Karena itu, dia menyelesaikan tugasnya dengan pendekatan yang penuh kerendahan hati, dan menghindari trik cerdik yang seperti penyakit.",
        name:"Edsger W. Dijkstra"
    },
    {
        quote:"Jika Anda akan melakukan sesuatu yang baru atau inovatif, Anda harus bersedia menerima kesalahpahaman.",
        name:"Jeff Bezos"
    },
    {
        quote:"Scrum itu seperti aturan sepak bola. Mematuhi aturannya tidak serta-merta membuat Anda menjadi pemain yang hebat.",
        name:"Jeff Sutherland"
    },
    {
        quote:"Musuh terbesar dari pengetahuan bukanlah ketidakpedulian, tetapi ilusi mengenai pengetahuan.",
        name:"Stephen Hawking"
    },
    {
        quote:"Hapiness is not something ready made. It comes from your own actions.",
        name:"Dalai Lama"
    }

];

var span = document.getElementById('quoteContainer');
var span = document.getElementById('quoteGenius');
var row = 0;
const quotediv= document.querySelector('#quotediv');

                  function timequote() {
                    row = row + 1;
                    var quote = $('#quoteContainer p').text();
                    var quoteGenius = $('#quoteGenius').text();
                    var sourceLength = quoteSource.length;
                    var randomNumber= Math.floor(Math.random()*sourceLength);
                    //set a new quote
                    var newQuoteText = quoteSource[randomNumber].quote;
                    var newQuoteGenius = quoteSource[randomNumber].name;
                    //console.log(newQuoteText,newQuoteGenius);
                    var timeAnimation = 700;
                    var quoteContainer = $('#quoteContainer');
                    //fade out animation with callback
                    quoteContainer.fadeOut(timeAnimation, function(){
                        quoteContainer.html('');
                                quoteContainer.append('<p>'+newQuoteText+'</p>'+'<p id="quoteGenius">'+'-								'+newQuoteGenius+'</p>');
                        //fadein animation.
                        quoteContainer.fadeIn(timeAnimation);
                    if(row == 20){
                        let divtag = `<div class="text-danger" style="width: 100%;
                        text-align: center;"><b>*Reminder : You Read Too Many Quotes, Please Consider There Is Work To Be Done :)</b></div>`;
                        quotediv.innerHTML = divtag;
                    }
            });
                  }
                  setInterval(timequote, 8000);
    //end for loop

//end quoteButton function
    
    
});//end document ready