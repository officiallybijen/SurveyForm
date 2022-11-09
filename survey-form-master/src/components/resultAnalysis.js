import { useState, useEffect } from "react";
import "survey-analytics/survey.analytics.min.css";
import { Model } from "survey-core";
import { VisualizationPanel } from "survey-analytics";
import Navbar from "./Navbar";

export default function ResultAnalysis() {
  const [questions, setQuestions] = useState(null);
  const [isLoading, setLoading] = useState();

  let surveyJson = {};



  const vizPanelOptions = {
    allowHideQuestions: false,
  };

  const [survey, setSurvey] = useState(null);
  const [vizPanel, setVizPanel] = useState(null);

  useEffect(() => {
    setLoading(true);
    fetch("http://127.0.0.1:8000/api/formquestion/" + 1, {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    })
      .then((res) => {
        return res.json();
      })
      .then((data) => {
        setQuestions(data);
        setLoading(false);
      });
  }, []);
  let quesName
  if(questions!=null){
    let ques=questions.filter((item)=>{
      item['name']="Favourite Player";
      return item.type=="dropdown"
    })
    quesName=ques[0].name
    console.log(ques[0].name)
    let surveyResults = [
      {
        "Favourite Player": "Lbj",
      },
      {
        "Favourite Player": "KD",
      },
      {
        "Favourite Player": "Lbj",
      },
      {
        "Favourite Player": "KD",
      },
      {
        "Favourite Player": "KD",
      },
    ];
    surveyResults.push({quesName:"das"});
    console.log(surveyResults)
    surveyJson={elements:[questions[1]]}

    // console.log(questions)

  
  if (!survey) {
    const survey = new Model(surveyJson);
    setSurvey(survey);
  }

  if (!vizPanel && !!survey) {
    const vizPanel = new VisualizationPanel(
      survey.getAllQuestions(),
      surveyResults,
      vizPanelOptions
    );
    vizPanel.showHeader = false;
    setVizPanel(vizPanel);
    
    vizPanel.render("surveyVizPanel");
    return () => {
      document.getElementById("surveyVizPanel").innerHTML = "";
    };
  }
}

  return (
    <div>
      <Navbar />
      <div id="surveyVizPanel" />
    </div>
  );
}
