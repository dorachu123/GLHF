<!DOCTYPE html>
<html lang="ja">
<head>
  <title><%= title %></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <link rel='stylesheet' href='/stylesheets/style.css'>
</head>
<body>
  <div class="wrapper">
    <p class="main-title"><%= title %></p>
    <% if (messageList.length) { %>
      <div class="white-bg">
        <ul class="main-list">
          <% messageList.forEach(function(messageItem) { %>
            <li class="main-list__item">
              <div class="message">
                <p class="message__title"><%= messageItem.content %></p>
                <p class="message__date"><%= messageItem.posted_at %></p>
              </div>
            </li>
            <% }); %>
          </ul>
        </div>
        <% } %>
        <form action="/board/<%= board.board_id %>" method="post" class="board-form">
          <input type="text" name="message" class="input" required>
          <button type="submit" class="submit">投稿</button>
        </form>
        <a href="/boards" class="btn">トップへもどる</a>
      </div>
    </body>
    </html>
