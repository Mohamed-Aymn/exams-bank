<script>
    import {
        ref
    } from 'vue';
    import * as d3 from "d3";

    export default {
        props: {
            data: Array,
            componentId: String,
            appendText: Boolean
        },
        setup(props) {
            const componentId = ref(props.componentId);
            const data = ref(props.data);

            return {
                componentId,
                data
            }
        },
        mounted() {
            const LABELPOSITION = 0.5;
            let data = this.data;
            // Select the chart div and set its dimensions.
            const chartDiv = d3.select(`#${this.componentId}`);
            const width = chartDiv.node().getBoundingClientRect().width;
            const height = Math.min(width, 500);

            // fetch colors from data array
            const colorScheme = {};
            for (let i = 0; i < data.length; i++) {
                colorScheme[data[i].name] = data[i].color
            }

            const color = d3
                .scaleOrdinal()
                .domain(data.map((d) => d.name))
                .range(Object.values(colorScheme));

            // Create the pie layout and arc generator.
            const pie = d3
                .pie()
                .sort(null)
                .value((d) => d.value);

            const arc = d3
                .arc()
                .innerRadius(0)
                .outerRadius(Math.min(width, height) / 2 - 1);

            // control the position of the label
            const labelRadius = arc.outerRadius()() * LABELPOSITION;

            // A separate arc generator for labels.
            const arcLabel = d3.arc().innerRadius(labelRadius).outerRadius(labelRadius);

            const arcs = pie(data);

            // Create the SVG container inside the chart div.
            const svg = chartDiv
                .append("svg")
                .attr("width", width)
                .attr("height", height)
                .attr("viewBox", [-width / 2, -height / 2, width, height])
                .attr("style", "max-width: 100%; height: auto; font: 10px sans-serif;");

            // Add a sector path for each value.
            svg
                .append("g")
                .attr("stroke", "white")
                .selectAll()
                .data(arcs)
                .join("path")
                .attr("fill", (d) => color(d.data.name))
                .attr("d", arc)
                .append("title")
                .text((d) => `${d.data.name}: ${d.data.value.toLocaleString("en-US")}`);

            if (this.appendText) {
                svg
                    .append("g")
                    .attr("text-anchor", "middle")
                    .selectAll()
                    .data(arcs)
                    .join("text")
                    .attr("transform", (d) => `translate(${arcLabel.centroid(d)})`)
                    .call((text) =>
                        text
                        .append("tspan")
                        .attr("y", "-0.4em")
                        .attr("font-weight", "bold")
                        .text((d) => d.data.name)
                    )
                    .call((text) =>
                        text
                        .filter((d) => d.endAngle - d.startAngle > 0.25)
                        .append("tspan")
                        .attr("x", 0)
                        .attr("y", "0.7em")
                        .attr("fill-opacity", 0.7)
                        .text((d) => d.data.value.toLocaleString("en-US"))
                    );

            }

            function chartAnimation() {
                // Update the arcs with the new data
                const arcs = pie(data);

                // Animate the chart from the initial value to the actual value
                svg
                    .selectAll("path")
                    .data(arcs)
                    .transition()
                    .duration(1000)
                    .attrTween("d", function(d) {
                        const interpolate = d3.interpolate({
                            startAngle: 0,
                            endAngle: 0
                        }, d);
                        return function(t) {
                            return arc(interpolate(t));
                        };
                    });

                // Update the labels with the new data and animate their appearance
                svg
                    .selectAll("text")
                    .data(arcs)
                    .transition()
                    .delay(1000) // Add a delay to make the labels appear after the pie animation is done
                    .duration(500) // Add a duration to animate the labels
                    .attr("transform", (d) => `translate(${arcLabel.centroid(d)})`)
                    .call((text) => text.select("tspan").text((d) => d.data.name))
            }

            // Call the updateChart function to render the chart with actual values
            chartAnimation();
        }
    }
</script>
<template>
    <div :id="componentId" />
</template>
