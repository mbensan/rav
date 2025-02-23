async function get_feed () {
  let feed = await fetch('/rav_basic_feed/rav_basic_feed.php')
  feed = await feed.json()

  draw_feed(feed);
  console.log(feed)
}
get_feed()

function draw_feed (feed) {
  const ig_feed = document.querySelector('#ig_feed')
  let feed_html = ''

  for (let i=0; i<4; i++) {
    const post = feed.data[i]

    feed_html += `
    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
      <div class="member" data-aos="fade-up" data-aos-delay="100">
        <div class="member-img">
          <img src="${post.media_url}" class="img-fluid" alt="">
          <div class="social text-center">
            <a target="_blank" href="https://www.instagram.com/ravuchilebilbao/"><i class="bi bi-instagram"></i></a>
          </div>
        </div>
        <div class="member-info">
          <span>${post.caption}</span>
        </div>
      </div>
    </div>
    `
  }

  ig_feed.innerHTML = feed_html
  ig_feed.classList.remove('d-none')
}