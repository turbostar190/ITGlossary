import React from 'react';
import Select from 'react-select';
import { PageTitle } from '../PageTitle';
import { Title } from '../Title';
import { AudioButton } from '../AudioButton';
import { Def } from '../Def';
import { Link } from '../Link';
import { RandomButton } from '../RandomButton';
import '../../../node_modules/react-select/dist/react-select.min.css';

export class Input extends React.Component {
  constructor(props) {
    super(props);
    const initialTxt = `Hi, this is a digital glossary of computer science words.
                  We have created this web application to collect all the terms that we programmers use in everyday life.
                  Using this app, people who are not pratical with the technology field can learn new
                  words concearning computer science.
                  An interesting feature is that you can pick a word totally at random. This mode can be used by clicking the blue button in the right bottom corner.
                  Enjoy the application and make good use of it!
                  <h6>Biondani Mattia, Bussola Riccardo, Cucino Federico, Giacopuzzi Marco, Montagna Federico, Zenti Chiara - 4^Ai 2017/2018</h6>`;
    this.state = {
      json: [],
      autoComp: "Welcome!",
      txt: initialTxt,
      link: null,
      phoneticSpelling: null,
      value: null,
      audioSrc: null,
    };
    this.onSelect = this.onSelect.bind(this);
  }

  getNameWhileTyping(input) {
    if (!input) return Promise.resolve({ options: [] });
    return fetch(`./api/search/?req=${input}`)
      .then((res) => {
        return res.json()
      })
      .then((data) => {
        return { options: data };
      });
  };

  onSelect(value) {
    this.setState({
      value: value,
    });
    this.getInfoFromWord(value);
  };

  getInfoFromWord(value) {
    if (!value) return;
    return fetch(`./api/getData/?word=${value.name}`)
      .then((res) => {
        return res.json()
      })
      .then((data) => {
        this.setState({
          autoComp: data.name,
          txt: data.def,
          link: data.link,
          audioSrc: data.audioFile,
          phoneticSpelling: data.phoneticSpelling,
        });
      });
  }

  getInfoFromRandomButton() {
    fetch(`./api/random/`)
      .then((res) => {
        return res.json()
      })
      .then((data) => {
        this.setState({
          autoComp: data.name,
          txt: data.def,
          link: data.link,
          audioSrc: data.audioFile,
          phoneticSpelling: data.phoneticSpelling,
        });
      });
  }

  render() {
    const AsyncComponent = Select.Async;

    return (
      <div>
        <div className="row left-align">
          <form className="col s12 center-align">
            <div className="row">
              <div className="col l0" />
              <PageTitle name={"ITGlossary"} />
              <div className="input-field col s11">
                {/*<i className="material-icons prefix">library_books</i>*/}
                {/* https://github.com/JedWatson/react-select */}
                <AsyncComponent
                  multi={false}
                  value={this.state.value}
                  onChange={this.onSelect}
                  valueKey="name"
                  labelKey="name"
                  loadOptions={this.getNameWhileTyping}
                  backspaceRemoves={true}
                  placeholder={"Search word..."}
                  // style={{ marginLeft: "2%" }}
                />
              </div>
            </div>
          </form>
          <ul className="collection with-header">
            <li className="collection-header">
              <Title name={this.state.autoComp} />
              <AudioButton
                phoneticSpelling={this.state.phoneticSpelling}
                src={this.state.audioSrc}
              />
            </li>
            <Def txt={this.state.txt} />
            <Link src={this.state.link} />
          </ul>
        </div>
        <footer
          className="page-footer"
          style={{
            position: "fixed",
            bottom: 0,
            left: 0,
            width: "100%",
            backgroundColor: "rgba(255,255,255,0)"
          }}
        >
          <RandomButton
            onClick={this.getInfoFromRandomButton.bind(this)}
            tooltip={"Random word"}
          />
        </footer>
      </div>
    );
  }
}
