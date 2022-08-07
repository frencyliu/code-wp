<?php



function the_notification_bell(){
?>
<style>
.notification-bell,
.notification-bell svg {
  position: relative;
  width: 3rem;
  height: 3rem;
}

.notification-bell svg > path {
  fill: #FFFFFF;
}
.notification--bell {
  animation: bell 2.2s linear infinite;
  transform-origin: 50% 0%;
}
.notification--bellClapper {
  animation: bellClapper 2.2s 0.1s linear infinite;
}
.notification--num {
  position: absolute;
  top: -10%;
  left: 60%;
  font-size: 1.25rem;
  border-radius: 50%;
  width: 0.35rem;
  height: 0.35rem;
  background-color: #FF4C13;
  border: 4px solid #FF4C13;
  color: #FFFFFF;
  text-align: center;
  animation: notification 2.2s linear;
}

@keyframes bell {
  0%, 25%, 75%, 100% {
    transform: rotate(0deg);
  }
  40% {
    transform: rotate(10deg);
  }
  45% {
    transform: rotate(-10deg);
  }
  55% {
    transform: rotate(8deg);
  }
  60% {
    transform: rotate(-8deg);
  }
}
@keyframes bellClapper {
  0%, 25%, 75%, 100% {
    transform: translateX(0);
  }
  40% {
    transform: translateX(-0.15em);
  }
  45% {
    transform: translateX(0.15em);
  }
  55% {
    transform: translateX(-0.1em);
  }
  60% {
    transform: translateX(0.1em);
  }
}
@keyframes notification {
  0%, 25%, 75%, 100% {
    opacity: 1;
  }
  30%, 70% {
    opacity: 0;
  }
}
    </style>

<div class="notification-bell">
    <svg viewbox="-10 0 35 35">
      <path class="notification--bell" d="M14 12v1H0v-1l0.73-0.58c0.77-0.77 0.81-3.55 1.19-4.42 0.77-3.77 4.08-5 4.08-5 0-0.55 0.45-1 1-1s1 0.45 1 1c0 0 3.39 1.23 4.16 5 0.38 1.88 0.42 3.66 1.19 4.42l0.66 0.58z"></path>
      <path class="notification--bellClapper" d="M7 15.7c1.11 0 2-0.89 2-2H5c0 1.11 0.89 2 2 2z"></path>
    </svg>
    <span class="notification--num"></span>
  </div>


<?php
}