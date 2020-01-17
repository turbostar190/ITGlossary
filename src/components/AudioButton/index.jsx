import React from 'react';
import PropTypes from 'prop-types';

const playAudio = () => {
  var myAudio = document.getElementById("audio");
  myAudio.load();
  myAudio.addEventListener("canplay", function () {
    myAudio.play();
  });
};

export const AudioButton = props => {
  return (props.src && props.src !== "404")
    ? (
      <div>
        <button
          onClick={playAudio}
          className="btn waves-effect waves-light waves-light blue darken-3"
          type="button"
          name="action"
          id="audioButton"
        >
          {props.phoneticSpelling}
          <i className="material-icons right">record_voice_over</i>
        </button>
        <audio id="audio">
          <source type="audio/mpeg" src={props.src} />
        </audio>
      </div>
    )
    : (
      null
    );
};

AudioButton.propTypes = {
  phoneticSpelling: PropTypes.string,
  src: PropTypes.string,
};
