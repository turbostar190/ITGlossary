import React from 'react';
import PropTypes from 'prop-types';
import ReactTooltip from 'react-tooltip';

export const RandomButton = props => {
  return (
    <div className="footer-copyright" style={{ backgroundColor: "rgba(255,255,255,0)" }}>
      <div className="container s12 right-align">
        <button
          onClick={props.onClick}
          data-tip={props.tooltip}
          id="random"
          className="btn-floating btn-large waves-effect waves-light blue darken-3 tooltipped"
          type="submit"
          name="action"
          data-position="left"
        >
          <i className="material-icons right">autorenew</i>
        </button>
      </div>
      <ReactTooltip place="left" type="dark" effect="solid" />
    </div>
  );
};

RandomButton.propTypes = {
  onClick: PropTypes.func.isRequired,
  tooltip: PropTypes.string.isRequired,
};
